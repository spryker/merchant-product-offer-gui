<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantProductOfferGui\Communication\Plugin\ProductOfferGui;

use Generated\Shared\Transfer\ProductOfferTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductOfferGuiExtension\Dependency\Plugin\ProductOfferViewSectionPluginInterface;

/**
 * @method \Spryker\Zed\MerchantProductOfferGui\Communication\MerchantProductOfferGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\MerchantProductOfferGui\MerchantProductOfferGuiConfig getConfig()
 */
class MerchantProductOfferViewSectionPlugin extends AbstractPlugin implements ProductOfferViewSectionPluginInterface
{
    /**
     * {@inheritDoc}
     * - Returns template for render merchant info.
     *
     * @api
     *
     * @return string
     */
    public function getTemplate(): string
    {
        return '@MerchantProductOfferGui/_partials/info-merchant.twig';
    }

    /**
     * {@inheritDoc}
     * - Returns merchant data from provided ProductOffer transfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductOfferTransfer $productOfferTransfer
     *
     * @return array<string, mixed>
     */
    public function getData(ProductOfferTransfer $productOfferTransfer): array
    {
        return $this->getFactory()
            ->createMerchantProductOfferReader()
            ->getMerchantData($productOfferTransfer);
    }
}
