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
   * @return string
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
    $nid = $node->nid->value;
    $form['email'] = array(
      '@title' => t('Email address'),
      '@type' => 'textfield',
      '@size' => 25,
      '@description' => t("We ' ll send update to the mail address you provide."),
      '@required' => TRUE,
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

}
