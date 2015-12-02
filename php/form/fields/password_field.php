<?php
class PasswordField extends Field {
    public function __toString() {
        return "<div class=\"form-field field-type-password\">
            <input type=\"password\" {$this->getAttrStr()} />
        </div>";
    }
}
