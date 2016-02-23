<?php
// Information for contacts.
$contactForm = new Form( array(
    'action' => new Action( 'contactUs' ),
    'fields' => array(
        new TextField( array(
            'name'        => 'name',
            'placeholder' => 'John Doe',
        ) ),
        new TextField( array(
            'name'        => 'email',
            'placeholder' => 'example@email.com',
        ) ),
        new TextAreaField( array(
            'name'        => 'message',
            'placeholder' => 'Your message here.',
        ) ),
        new SubmitField( array(
            'name'  => 'submit',
            'value' => 'Send',
        ) ),
    )
), false);
?>

<div id="contact" class="page-section">

    <?php $contactInfo = PageDescription::getFromName( 'contact' ); ?>

    <section class="content">

        <h1><?php print $contactInfo->title; ?></h1>

        <?php echo $contactForm; ?>

    </section>

</div> <!-- #contact -->
