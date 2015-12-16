<?php
class TextField extends Field {
    public function __toString() {
        return "<div class=\"form-field field-type-text\">
            <div class=\"field-name\">
                <span>{$this->getPublic('title')}</span>
            </div>
            <div class=\"field-description\">
                <span>{$this->getPublic('description')}</span>
            </div>
            <input type=\"text\" {$this->getAttrStr()} />
        </div>";
    }
}
