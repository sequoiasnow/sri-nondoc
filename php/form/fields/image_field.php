<?php
class ImageField extends Field {
    public function __toString() {
        return "<div class=\"form-field field-type-image\">
            <div class=\"select-image\"></div>
        </div>";
    }
}
