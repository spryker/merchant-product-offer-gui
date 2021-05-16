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
            ->setJoinType(Criteria::LEFT_JOIN)
            ->setLeft([SpyProductOfferTableMap::COL_MERCHANT_REFERENCE])
            ->setRight([SpyMerchantTableMap::COL_MERCHANT_REFERENCE]);
        ;

        if ($merchantProductOfferCriteriaTransfer->getIdMerchant()) {
            $queryJoinTransfer->setJoinType(Criteria::INNER_JOIN)
                ->setCondition(
                    sprintf(
                        '%s = %s AND %s = %d',
                        SpyProductOfferTableMap::COL_MERCHANT_REFERENCE,
                        SpyMerchantTableMap::COL_MERCHANT_REFERENCE,
                        SpyMerchantTableMap::COL_ID_MERCHANT,
                        $merchantProductOfferCriteriaTransfer->getIdMerchant()
                    )
                );
        }

        $queryCriteriaTransfer->addJoin($queryJoinTransfer)
            ->setWithColumns([SpyMerchantTableMap::COL_NAME => MerchantTransfer::NAME]);

        return $queryCriteriaTransfer;
    }
}
