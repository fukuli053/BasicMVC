<?php 

    function inputBlock($type, $label, $name, $value='', $inputAttrs=[], $divAttrs=[])
    {   
        $divString = attrsToString($divAttrs);
        $inputString = attrsToString($inputAttrs);
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
    function submitBlock($buttonText, $inputAttrs=[], $divAttrs=[]){
        $divString = attrsToString($divAttrs);
        $inputString = attrsToString($inputAttrs);
        $html = '<div'.$divString.'>';
        $html .= '<input type="submit" value="'.$buttonText.'"'.$inputString.' />';
        $html .= '</div>';
        return $html;
    }

    function submitTag($buttonText, $inputAttrs)
    {
        $inputString = attrsToString($inputAttrs);
        $html = '<input type="button"' .$inputString. ' value="'. $buttonText . '"/>';
        return $html;
    }

    function attrsToString($attrs)
    {
        $string = '';
        foreach($attrs as $key => $value){
            $string .= ' ' . $key . ' = "' . $value . '"' ;
        }
        return $string;
    }