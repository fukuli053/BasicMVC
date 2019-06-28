<?php 

class FH {

    public static function inputBlock($type, $label, $name, $value='', $inputAttrs=[], $divAttrs=[])
    {   
        $divString = self::attrsToString($divAttrs);
        $inputString = self::attrsToString($inputAttrs);
        $html = '<div ' . $divString . '>';
        $html .= '<label for="'.$name.'">' . $label . '</label>';
        $html .= '<input '. $inputString .' type="'.$type.'" name="'.$name.'" id="'.$name.'" value="'.$value.'" />'; 
        $html .= '</div>';

        return $html;
    }

    /**
     * Creates a submit block
     * @method submitBlock
     * @param  string      $buttonText Text that will be displayed on button
     * @param  array       $inputAttrs (optional) Attributes for input
     * @param  array       $divAttrs   (optional) Atributes for surrounding div
     * @return string                  Returns an html string for submit block
     */
    public static function submitBlock($buttonText, $inputAttrs=[], $divAttrs=[]){
        $divString = self::attrsToString($divAttrs);
        $inputString = self::attrsToString($inputAttrs);
        $html = '<div'.$divString.'>';
        $html .= '<input type="submit" value="'.$buttonText.'"'.$inputString.' />';
        $html .= '</div>';
        return $html;
    }

    public static function checkboxBlock($label,$name,$checked=false,$inputAttrs=[],$divAttrs=[]){
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);
        $checkString = ($checked)? ' checked="checked"' : '';
        $html = '<div'.$divString.'>';
        $html .= '<label for="'.$name.'">'.$label.' <input type="checkbox" id="'.$name.'" name="'.$name.'" value="on"'.$checkString.$inputString.'></label>';
        $html .= '</div>';
        return $html;
    }
    
    public static function stringifyAttrs($attrs){
    $string = '';
    foreach($attrs as $key => $val){
        $string .= ' ' . $key . '="' . $val . '"';
    }
    return $string;
    }

    public static function submitTag($buttonText, $inputAttrs)
    {
        $inputString = self::attrsToString($inputAttrs);
        $html = '<input type="button"' .$inputString. ' value="'. $buttonText . '"/>';
        return $html;
    }

    public static function attrsToString($attrs)
    {
        $string = '';
        foreach($attrs as $key => $value){
            $string .= ' ' . $key . ' = "' . $value . '"' ;
        }
        return $string;
    }

    public static function generateToken()
    {
        $token = base64_encode(openssl_random_pseudo_bytes(32));
        Session::set('csrf_token', $token);
        return $token;
    }

    public static function checkToken($token)
    {
        return (Session::exists('csrf_token') && (Session::get('csrf_token') == $token));
    }

    public static function csrfInput()
    {
        $input = FH::inputBlock('hidden', '', 'csrf_token',self::generateToken());
        return $input;
    }

    public static function sanitize($dirty)
    {
        return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
    }

    public static function posted_values($post)
    {
        $clean_array = [];
        foreach ($post as $key => $value) {
            $clean_array[$key] = self::sanitize($value);
        }
        return $clean_array;
    }

    public static function displayErrors($errors)
    {
        $html = '<div class="alert alert-danger">';
        $html.= '<ul>';
        foreach ($errors as $field => $error) {        
            $html .= '<li>' . $error . '<li>';     
            $html .= '<script> $("document").ready(function() {
                $("#'.$field.'").parent().closest("div").addClass("has-error");
            }); </script>';   
        }
        $html .= '</ul>';
        $html .= '</div>';
        return $html;
    }

}
