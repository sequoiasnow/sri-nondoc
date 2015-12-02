<?php
class PasswordField extends Field {
    public function __toString() {
        return "<div class=\"form-field field-type-textarea\">
            <textarea {$this->getAttrStr()} ></textarea>
        </div>";
    }
}
