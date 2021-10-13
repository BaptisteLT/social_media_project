<?php
namespace App\Entity;

class Formulaire2
{
    public static $FORM_END ='</form>';


    /**
     * @var string $name
     * @var string method: POST/GET (Optional default POST)
     * @var bool $autocomplete: whether the form should have autocomplete (Optional default on)
     */
    public static function formBegin($name,$method="POST",$autocomplete=1)
    {
        return '<form name="'.$name.'">';
    }


    /**
     * @var string $type (Optional default textbox)
     */
    public static function formInput($type='textbox',$required=1,$inputId="", $labelContent="",$value="")
    {
        $string='';
        if($inputId != "")
        {
            if($labelContent==="")
            {
                $string .= '<label for'.$inputId.'>'.$inputId.'</label>';
            }
            else
            {
                $string .= '<label for'.$inputId.'>'.$labelContent.'</label>';;
            }
        }
        $string .= '<input id="'.$inputId.'" type="'.$type.'"></input>';

        return $string;
    }

    /**
     * return @var string
     */
    public static function formEnd()
    {
        return self::$FORM_END;
    }
}