<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\CollaborationtoolnotificationBundle;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Trilobit\WorldofimagesBundle\DependencyInjection\WorldofimagesExtension;

class TrilobitCollaborationtoolnotificationBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new WorldofimagesExtension();
    }
}
