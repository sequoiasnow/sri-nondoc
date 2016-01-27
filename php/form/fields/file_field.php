<?php
class FileField extends Field {
    public function __toString() {
        return "<div class=\"form-field field-type-image\">
            <div class=\"field-name\">
                <span>{$this->getPublic('title')}</span>
            </div>
            <div class=\"field-description\">
                <span>{$this->getPublic('description')}</span>
            </div>
            <input type=\"file\" {$this->getAttrStr()} />
        </div>";
    }
}
