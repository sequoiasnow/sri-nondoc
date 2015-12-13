<?php
class PasswordField extends Field {
    public function __toString() {
        return "<div class=\"form-field field-type-password\">
            <div class=\"field-name\">
                <span>{$this->getPublic('name')}</span>
            </div>
            <div class=\"field-description\">
                <span>{$this->getPublic('description')}</span>
            </div>
            <input type=\"password\" {$this->getAttrStr()} />
        </div>";
    }
}
