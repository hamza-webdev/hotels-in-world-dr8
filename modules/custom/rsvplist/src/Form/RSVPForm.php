<?php
/**
 * @file
 * Contains \Drupal\rsvplist\Form\RSVPForm
 */

namespace Drupal\rsvplist\Form;

use Drupal\Core\Database;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;

/**
 * Provide an RSVP Email form
 * Class RSVPForm
 * @package Drupal\rsvplist\Form
 */
class RSVPForm extends FormBase {
  /**
   * (@inheritDoc)
   *
   */
  public function getFormId()
  {
    return 'rsvplist_email_form';
  }

  /**
   * (@inheritDoc)
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $node = \Drupal::routeMatch()->getParameter('node');

    $nid = null;
    if ($node instanceof \Drupal\node\NodeInterface) {
      $nid = $node->id()->value;
    }
    $form['email'] = array(
      '#title' => t('Email address'),
      '#type' => 'textfield',
      '#size' => 25,
      '#description' => t("We ' ll send update to the mail address you provide."),
      '#required' => TRUE,
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('RSVP'),
    );
    $form['nid'] = array(
      '#type' => 'hidden',
      '#value' => $nid,
    );
    return $form;
  }

  /**
   * (@inheritDoc)
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    $value = $form_state->getValue('email');
    if ($value == !\Drupal::service('email.validator')->isValid($value)) {
      $form_state->setErrorByName('email', t('The email address %mail is not valid', array(
        '%mail' => $value
      )));
    }
  }


  /**
   * (@inheritDoc)
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
    db_insert('rsvplist')
      ->fields(array(
        'mail' => $form_state->getValue('email'),
        'nid' => $form_state->getValue('nid'),
        'uid' => $user->id(),
        'created' => time()
      ))
      ->execute();
    drupal_set_message(t('Meri pour votre RSVP, vous etes dans la list des evenements '));
  }

}
