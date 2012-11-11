<?php
class Forms_Profile extends Zend_Form
{
public function init()
{

$firstname = new Zend_Form_Element_Text('first_name');
$firstname->setLabel('First Name')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');


$lastname = new Zend_Form_Element_Text('last_name');
$lastname->setLabel('Last Name')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');


$schoolyear = new Zend_Form_Element_Text('school_year');
$schoolyear->setLabel('School Year')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');


$classyear = new Zend_Form_Element_Text('class_year');
$classyear->setLabel('Class Year')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');


$phonenumber = new Zend_Form_Element_Text('phone_num');
$phonenumber->setLabel('Phone Number')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');


$facebook = new Zend_Form_Element_Text('facebook');
$facebook->setLabel('Facebook')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');



$linkedin = new Zend_Form_Element_Text('linkedin');
$linkedin->setLabel('LinkedIn')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');



$twitter = new Zend_Form_Element_Text('twitter');
$twitter->setLabel('Twitter')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');



$location = new Zend_Form_Element_Text('location');
$location->setLabel('Location')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');



$status = new Zend_Form_Element_Text('status');
$status->setLabel('Status')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');



$altemail = new Zend_Form_Element_Text('altemail');
$altemail->setLabel('Alternative Email')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');




$summary = new Zend_Form_Element_Textarea('summary');
$summary->setLabel('Summary')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');




$interests = new Zend_Form_Element_Text('interests');
$interests->setLabel('Interests')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');



$favstuspot = new Zend_Form_Element_Text('favstuspot');
$favstuspot->setLabel('Favorite Study Spot')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');


$favdrink = new Zend_Form_Element_Text('favdrink');
$favdrink->setLabel('Favorite Drink')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');



$pet = new Zend_Form_Element_Text('pet');
$pet->setLabel('Pet')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');


$petpeeve = new Zend_Form_Element_Text('petpeeve');
$petpeeve->setLabel('Pet Peeve')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');



$submit = new Zend_Form_Element_Submit('submit');

$this->addElements(array($firstname, $lastname, $schoolyear, $classyear, $phonenumber, $facebook, $linkedin, $twitter, $location, $status, $altemail, $summary, $interests, $favstuspot, $favdrink, $pet, $petpeeve, $submit));
}
}