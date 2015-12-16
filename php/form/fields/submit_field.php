<?php

class SubmitField extends Field {
    public function __toString() {
        return
        "<div class=\"form-field field-type-submit\">
            <input type=\"submit\" value=\"Save\" />
        </div>";
    }
}
