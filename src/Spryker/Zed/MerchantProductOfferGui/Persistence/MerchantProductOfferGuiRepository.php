<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantProductOfferGui\Persistence;

use Generated\Shared\Transfer\MerchantProductOfferCriteriaTransfer;
use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\QueryCriteriaTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\Merchant\Persistence\Map\SpyMerchantTableMap;
use Orm\Zed\ProductOffer\Persistence\Map\SpyProductOfferTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Spryker\Zed\MerchantProductOfferGui\Persistence\MerchantProductOfferGuiPersistenceFactory getFactory()
 */
class MerchantProductOfferGuiRepository extends AbstractRepository implements MerchantProductOfferGuiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\QueryCriteriaTransfer $queryCriteriaTransfer
     * @param \Generated\Shared\Transfer\MerchantProductOfferCriteriaTransfer $merchantProductOfferCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\QueryCriteriaTransfer
     */
    public function expandQueryCriteriaTransfer(
        QueryCriteriaTransfer $queryCriteriaTransfer,
        MerchantProductOfferCriteriaTransfer $merchantProductOfferCriteriaTransfer
    ): QueryCriteriaTransfer {
        $queryJoinTransfer = (new QueryJoinTransfer())
            ->setJoinType(Criteria::INNER_JOIN)
            ->setRelation('SpyMerchant');

        if ($merchantProductOfferCriteriaTransfer->getIdMerchant()) {
            $queryJoinTransfer->setCondition(sprintf('%s = %d', SpyProductOfferTableMap::COL_FK_MERCHANT, $merchantProductOfferCriteriaTransfer->getIdMerchant()));
        }

        $queryCriteriaTransfer->addJoin($queryJoinTransfer)
            ->setWithColumns([
                SpyMerchantTableMap::COL_NAME => MerchantTransfer::NAME,
            ]);

        return $queryCriteriaTransfer;
    }
}
