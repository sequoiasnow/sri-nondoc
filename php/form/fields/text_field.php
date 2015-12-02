<?php
class TextField extends Field {
    public function __toString() {
        return "<div class=\"form-field field-type-text\">
            <input type=\"text\" {$this->getAttrStr()} />
        </div>";
    }
}
