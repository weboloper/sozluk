<?php
namespace Weboloper\Frontend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;

// use Weboloper\Models\Profiles;

class EntryForm extends Form
{

    public function initialize($entity = null, $options = null)
    {

        if (!is_null($entity)) {
            $this->add(new Hidden('id'));
        }
        $content = new TextArea(
            'content',
            [
                'placeholder' =>  'emtry giriniz ' 
            ]
        );
        $content->addValidator(
            new PresenceOf(
                [
                    'message' =>  'entry formu boş gönderilemez'
                ]
            )
        );
        $this->add($content);
        $this->add(new Hidden('objectId'));
        $this->add(new Hidden('objectTitle'));
         
    }
}
