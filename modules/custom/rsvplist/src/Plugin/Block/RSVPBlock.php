<?php
/**
 * @file
 * Contains \Drupal\rsvplist\Plugin\Block\RSVPBlock
 */

namespace Drupal\rsvplist\Plugin\Block;

use \Drupal\Core\Block\BlockBase;
use \Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Provides an 'RSVP' List Block
 * @Block(
 *   id = "rsvp_block",
 *   admin_label = @translation("RSVP Block"),
 *   )
 */

class RSVPBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */

  public function build()
  {
    return \Drupal::formBuilder()->getForm('Drupal\rsvplist\Form\RSVPForm');
  }

  /**
   * @param AccountInterface $account
   * @return AccessResult|\Drupal\Core\Access\AccessResultForbidden
   */
  public function blockAccess(AccountInterface $account)
  {
    /**
     * @var \Drupal\node\Entity\Node $node
     */
    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = null;
    if ($node instanceof \Drupal\node\NodeInterface) {
      $nid = $node->id();
      if(is_numeric($nid)) {
        return AccessResult::allowedIfHasPermissions($account, array('view rsvplist'));
      }
    }
    return AccessResult::forbidden();
  }

}
