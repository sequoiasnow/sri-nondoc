<?php
class PasswordField extends Field {
    public function __construct( $args ) {
        parent::__construct( $args );

        if ( isset( $this['value'] ) ) {
            unset( $this['value'] );
        }
    }

    public function __toString() {
        return "<div class=\"form-field field-type-password\">
            <div class=\"field-name\">
                <span>{$this->getPublic('title')}</span>
            </div>
            <div class=\"field-description\">
                <span>{$this->getPublic('description')}</span>
            </div>
            <input type=\"password\" {$this->getAttrStr()} />
        </div>";
    }
}
