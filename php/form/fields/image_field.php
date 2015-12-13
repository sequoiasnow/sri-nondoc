<?php
class ImageField extends Field {
    public function __toString() {
        return "<div class=\"form-field field-type-image\">
            <div class=\"field-name\">
                <span>{$this->getPublic('name')}</span>
            </div>
            <div class=\"field-description\">
                <span>{$this->getPublic('description')}</span>
            </div>
            <div class=\"select-image\"></div>
        </div>";
    }
}
