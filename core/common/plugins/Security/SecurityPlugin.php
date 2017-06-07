<?php

namespace Weboloper\Plugins\Security;

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

use Weboloper\Models\Users;
use Weboloper\Models\Profiles;

/**
 * SecurityPlugin
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class SecurityPlugin extends Plugin
{	

	/**
     * Human-readable descriptions of the actions used in {@see $privateResources}
     *
     * @var array
     */
    private $actionDescriptions = [
        'index' => 'Access',
        'search' => 'Search',
        'create' => 'Create',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'changePassword' => 'Change password'
    ];


	/**
	 * Returns an existing or new access control list
	 *
	 * @returns AclList
	 */

	public function getAcl()
	{
		if (!isset($this->persistent->acl)) {

			$acl = new AclList();

			$acl->setDefaultAction(Acl::DENY);
			// $acl->setDefaultAction(Acl::ALLOW);

			// Register roles
			$profiles = Profiles::find([
	            'active = :active:',
	            'bind' => [
	                'active' => 'Y'
	            ]
	        ]);

			foreach ($profiles as $profile) {
	            $acl->addRole(new Role($profile->name));
	        }
			 
			//Private area resources
			foreach ($this->privateResources() as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
				//Grant all private resources for admin
			}

			// Grant access to private area to role Users
	        foreach ($profiles as $profile) {
	            // Grant permissions in "permissions" model
	            foreach ($profile->getPermissions() as $permission) {
	                $acl->allow($profile->name, $permission->resource, $permission->action);
	            }
	            // Always grant these permissions
	            // $acl->allow($profile->name, 'user', 'changePassword');
	        }

			// Grant access to private area to role Users
			foreach ($this->privateResources() as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow( Users::ROLE_ADMIN , $resource, $action);
				}
			}

			//The acl is stored in session, APC would be useful here too
			$this->persistent->acl = $acl;
		}

		return $this->persistent->acl;
	}

	/**
	 * This action is executed before execute any action in the application
	 *
	 * @param Event $event
	 * @param Dispatcher $dispatcher
	 * @return bool
	 */
	public function beforeDispatch(Event $event, Dispatcher $dispatcher)
	{

		$auth = $this->session->get('auth-identity');

		if (!is_array($auth)) {
            $this->flash->notice('You don\'t have access to this module: private');
            $this->response->redirect('/');
            return false;
        }

        if(!$this->auth->isTrustModeration()){
            $this->flash->notice('You don\'t have access to this module: private');
            $this->response->redirect('/');
            return false;
        }


        $role = $auth['profile'];

		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();

		if(!isset( $this->privateResources()[$controller])) {
			return true;
		}

		$acl = $this->getAcl();

		if (!$acl->isResource($controller)) {
			$this->dispatcher->forward([
				'namespace' => 'Weboloper\Backend\Controllers\\',
				'controller' => 'dashboard',
				'action'     => 'index'
			]);

			return false;
		}

		$allowed = $acl->isAllowed($role, $controller, $action);
		if (!$allowed) {
			$this->dispatcher->forward(array(
				'namespace' => 'Weboloper\Backend\Controllers\\',
				'controller' => 'dashboard',
				'action'     => 'index'
			));
            $this->session->destroy();
			return false;
		}
	}


	protected function privateResources()
	{	
		// if a controller set private you must set public resources too
		return $privateResources = array(
				'profiles'    	=> array('index', 'edit', 'delete', 'create'),
				'users'    		=> array('index', 'edit', 'delete', 'create', 'search'),
				'permissions'   => array('index')
			);
	}
 
	/**
     * Returns the permissions assigned to a profile
     *
     * @param Profiles $profile
     * @return array
     */
    public function getPermissions(Profiles $profile)
    {
        $permissions = [];
        foreach ($profile->getPermissions() as $permission) {
            $permissions[$permission->resource . '.' . $permission->action] = true;
        }
        return $permissions;
    }


    /**
     * Returns all the resources and their actions available in the application
     *
     * @return array
     */
    public function getResources()
    {
        return $this->privateResources();
    }

    /**
     * Returns the action description according to its simplified name
     *
     * @param string $action
     * @return string
     */
    public function getActionDescription($action)
    {
        if (isset($this->actionDescriptions[$action])) {
            return $this->actionDescriptions[$action];
        } else {
            return $action;
        }
    }
}
