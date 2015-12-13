<?php

class SubmitField extends Field {
    public function __toString() {
        return
        "<div class=\"form-field field-type-text\">
            <input type=\"submit\" value=\"Submit\" />
        </div>";
    }
}
