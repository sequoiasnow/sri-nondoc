<?php
class TextareaField extends Field {
    public function __toString() {
        if ( ! $this['value'] ) { $this['value'] = ''; }
        return "<div class=\"form-field field-type-textarea\">
            <div class=\"field-name\">
                <span>{$this->getPublic('title')}</span>
            </div>
            <div class=\"field-description\">
                <span>{$this->getPublic('description')}</span>
            </div>
            <textarea {$this->getAttrStr()} >
                {$this['value']}
            </textarea>
        </div>";
    }
}
