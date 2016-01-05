<?php

class SubmitField extends Field {
    public function __toString() {
        // Ensure the value exists.
        if ( ! isset( $this['value'] ) ) {
            $this['value'] = 'Save';
        }

        return
        "<div class=\"form-field field-type-submit\">
            <input type=\"submit\" value=\"{$this['value']}\" />
        </div>";
    }
}
