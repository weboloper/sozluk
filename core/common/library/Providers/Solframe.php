<?php
 
namespace Weboloper\Providers;
 
class Solframe extends AbstractServiceProvider
{

	protected $serviceName = 'Solframe';

	public function register()
    {

	    $this->di->setShared(
	        $this->serviceName,
	        function () {

	        	return 'ccc';
	     });
	}

}	