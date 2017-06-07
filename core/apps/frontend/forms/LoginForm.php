<?php
namespace Weboloper\Frontend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;

class LoginForm extends Form
{

    public function initialize()
    {
        // Email
        $email = new Text('email', [
            'placeholder' => 'E-mail',
            'class' => 'form-control'
        ]);

        $email->addValidators([
            new PresenceOf([
                'message' => 'E-mail is required'
            ]),
            new Email([
                'message' => 'E-mail is not valid'
            ])
        ]);

        $this->add($email);

        // Password
        $password = new Password('password', [
            'placeholder' => 'Password',
            'class' => 'form-control'
        ]);

        $password->addValidator(new PresenceOf([
            'message' => 'Password is required'
        ]));

        $password->clear();

        $this->add($password);

        // Remember
        $remember = new Check('remember', [
            'value' => 'yes',
        ]);

        $remember->setLabel('Remember me');

        $this->add($remember);

    }

    /**
     * Prints messages for a specific element
     */
    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
               return "<div class='form-control-feedback text-danger'>". $message."</div>";
            }
        }
    }
}
