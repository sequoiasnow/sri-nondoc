<?php
class TextareaField extends Field {
    public function __toString() {
        return "<div class=\"form-field field-type-textarea\">
            <div class=\"field-name\">
                <span>{$this->getPublic('name')}</span>
            </div>
            <div class=\"field-description\">
                <span>{$this->getPublic('description')}</span>
            </div>
            <textarea {$this->getAttrStr()} ></textarea>
        </div>";
    }
}
