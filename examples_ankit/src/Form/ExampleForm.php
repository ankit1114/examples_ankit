<?php
/**
 * @file
 * Contains \Drupal\examples_ankit\Form\ExampleForm.
 */
namespace Drupal\examples_ankit\Form;

use \Drupal\node\Entity\Node;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ExampleForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'example_form';
  }

   /**
   * {@inheritdoc}
   */

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#required' => TRUE,
    );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => t('Email'),
      '#required' => TRUE,
    );
    $form['city'] = array (
      '#type' => 'textfield',
      '#title' => t('City'),
      '#required' => FALSE,
    );
    $form['country'] = array (
      '#type' => 'textfield',
      '#title' => t('Country'),
      '#required' => FALSE,
    );
    $form['sal'] = array (
      '#type' => 'textfield',
      '#title' => t('Sal'),
      '#required' => FALSE,
    );
    $form['contact_number'] = array (
      '#type' => 'tel',
      '#title' => t('Contact Number'),
      '#required' => TRUE,
    );
    /*$form['department'] = array(
      '#title' => 'Department',
      '#type' => 'select',
      '#vocabulary' => 6,
      '#parent_tid' => 0,
      '#value_key' => 'tid',
      kint($form['department']);
      exit();
    );*/
   /* $term_reference_tree_path = drupal_get_path('module', 'term_reference_tree');
    $form['department'] = array(
      '#title' => 'Department',
      '#type' => 'select',
      '#start_minimized' => TRUE,
      '#depth' => 0,
      '#vocabulary' => 5,
      '#parent_tid' => 0,
      '#value_key' => 'tid',
      '#select_parents' => TRUE,
    );*/
    $term_name = \Drupal\taxonomy\Entity\Term::load(2)->get('name')->value;
    $form['department'] = [
      '#type' => 'select',
      '#title' => $this->t('Department'),
      '#options' => $term_name,
    ];

    /*$form['deprtment'] = [
      '#type' => 'entity_autocomplete',
      '#title' => $this->t('Department'),
      '#target_type' => 'taxonomy_term',
      '#selection_settings' => [
        'target_bundles' => array($term_name),
      ],
    ];*/
    /*$form['deprtment'] = [
      '#type' => 'select',
      '#required' => TRUE,
      '#title' => $this->t('Department'),
      '#options' => [
        'accounts' => $this->t('Accounts'),
        'marketing' => $this->t('White'),
        'development' => $this->t('Development'),
        'design' => $this->t('Design'),
        'hr' => $this->t('HR'),
        'client_relation' => $this->t('Client Relation'),
      ],
    ];*/

    $form['exprience_in_years'] = array(
      '#type' => 'number',
      '#title' => t('Exprience in Years'),
      '#required' => FALSE,
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }
   /**
   * {@inheritdoc}
   */
  function validateForm(array &$form, FormStateInterface $form_state) {

    if (strlen($form_state->getValue('contact_number')) < 10) {
      $form_state->setErrorByName('contact_number', $this->t('Contact Number is too short.'));
    }
    if (!\Drupal::service('email.validator')->isValid($form_state->getValues()['email'])) {
      $form_state->setErrorByName('Email', $this->t('Invalid Email!'));
    }
    /*if (!valid_email_address($mail)) {
      form_set_error('submitted][email', t('Invalid Email!'));
   }*/

  }

  /**
  * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $my_article = Node::create([
      'type' => 'employee',
      'field_full_name' =>  $form_state->getValue('name'),
      'field_email' => $form_state->getValue('email'),
      'field_city' => $form_state->getValue('city'),
      'field_country' => $form_state->getValue('country'),
      'field_sal' => $form_state->getValue('sal'),
      'field_contact_number' => $form_state->getValue('contact_number'),
      'field_department' => $form_state->getValue('department'),
      'field_experience_in_year' => $form_state->getValue('exprience_in_years'),
    ]);
    $my_article->set('title', 'My Article');
    $my_article->save();

    /*foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }*/

  }
}
