<?php
namespace Weboloper\Frontend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Alnum;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class SignUpForm extends Form
{

    public function initialize($entity = null, $options = null)
    {
        $name = new Text('name', [
            'placeholder' => 'Name',
            'class' => 'form-control'
        ]);

        $name->setLabel('Name');

        $name->addValidators([
            new PresenceOf([
                'message' => 'Name is required'
            ])
        ]);

        $this->add($name);

        // Username
        $username = new Text('username', [
            'placeholder' => 'Username',
            'class' => 'form-control'
        ]);

        $username->setLabel('Username');

        $username->addValidators([
            new PresenceOf([
                'message' => 'Username is required'
            ]),
            new Alnum([
                'message' => ':field must contain only alphanumeric characters'
            ])

        ]);

        $this->add($username);

        // Email
        $email = new Text('email', [
            'placeholder' => 'E-mail',
            'class' => 'form-control'
        ]);

        $email->setLabel('E-mail');

        $email->addValidators([
            new PresenceOf([
                'message' => 'E-mail is required'
            ]),
            new Email([
                'message' => 'E-mail is required'
            ])
        ]);

        $this->add($email);

        // Password
        $password = new Password('password', [
            'placeholder' => 'Password',
            'class' => 'form-control'
        ]);

        $password->setLabel('Password');

        $password->addValidators([
            new PresenceOf([
                'message' => 'Password is required'
            ]),
            new StringLength([
                'min' => 8,
                'messageMinimum' => 'Password minimum 8 characters'
            ]),
            new Confirmation([
                'message' => 'Passwords not match',
                'with' => 'confirmPassword'
            ])
        ]);

        $this->add($password);

        // Confirm Password
        $confirmPassword = new Password('confirmPassword', [
            'placeholder' => 'Confirm Password',
            'class' => 'form-control'
        ]);

        $confirmPassword->setLabel('Confirm Password');

        $confirmPassword->addValidators([
            new PresenceOf([
                'message' => 'Confirm Password is required'
            ])
        ]);

        $this->add($confirmPassword);

        // Remember
        $terms = new Check('terms', [
            'value' => 'yes'
        ]);

        $terms->setLabel('Terms and conditions');

        $terms->addValidator(new Identical([
            'value' => 'yes',
            'message' => 'Terms and conditions required'
        ]));

        $this->add($terms);

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
