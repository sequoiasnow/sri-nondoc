<?php

class HiddenField extends Field {
    public function __toString() {
        return "<input type=\"hidden\" name=\"{$this['name']}\" value=\"{$this['value']}\" />";
    }
}
