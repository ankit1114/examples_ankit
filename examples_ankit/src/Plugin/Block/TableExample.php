<?php

namespace Drupal\examples_ankit\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Block\BlockPluginInterface;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "table_example_block",
 *   admin_label = @Translation("Table Example"),
 * )
 */
class TableExample extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $rows = array
        (
            array(1,"sagar wani", "sagar@gmail.com", 4000000, "director", 6),
            array(2,"john", "john@gmail.com", 500000, "developer", 6),
            array(3,"rahul", "rahulo@gmail.com", 600000, "developer", 7),
            array(4,"sonoo", "sonoo@gmail.com", 400000, "developer", 6),
            array(5,"john", "john@gmail.com", 500000, "developer", 6),
            array(6,"rahul", "rahulo@gmail.com", 600000, "developer", 7),
            array(7,"sonoo", "sonoo@gmail.com", 400000, "developer", 6),
            array(8,"john", "john@gmail.com", 500000, "developer", 6),
            array(9,"rahul", "rahulo@gmail.com", 600000, "developer", 7),
            array(10,"sonoo", "sonoo@gmail.com", 400000, "developer", 6),
            array(11,"john", "john@gmail.com", 500000, "developer", 6),
            array(12,"rahul", "rahulo@gmail.com", 600000, "developer", 7)
        );

    $headers = [
      'Id',
      'Employee Name',
      'Email ID',
      'Salary',
      'Designation',
      'Experience (In Years)'
    ];
    return [
      '#type' => 'table',
      '#header' => $headers,
      '#rows' => $rows,
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    return $form;
  }

  /**
   * {@inheritdoc}
   */

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['table_example_settings'] = $form_state->getValue('table_example_settings');
  }
}
