<?php
/**
 * Copyright (c) 2017, Nosto Solutions Ltd
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * 3. Neither the name of the copyright holder nor the names of its contributors
 * may be used to endorse or promote products derived from this software without
 * specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @author Nosto Solutions Ltd <contact@nosto.com>
 * @copyright 2017 Nosto Solutions Ltd
 * @license http://opensource.org/licenses/BSD-3-Clause BSD 3-Clause
 *
 */

namespace Nosto\Tagging\Block;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Nosto\Tagging\Helper\Account as NostoHelperAccount;
use Nosto\Tagging\Model\Category\Builder as NostoCategoryBuilder;

/**
 * Category block used for outputting meta-data on the stores category pages.
 * This meta-data is sent to Nosto via JavaScript when users are browsing the
 * pages in the store.
 */
class Category extends Template
{
    use TaggingTrait;

    private $registry;
    private $categoryBuilder;

    /**
     * Constructor.
     *
     * @param Template\Context $context
     * @param Registry $registry
     * @param NostoCategoryBuilder $categoryBuilder
     * @param NostoHelperAccount $nostoHelperAccount
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Registry $registry,
        NostoCategoryBuilder $categoryBuilder,
        NostoHelperAccount $nostoHelperAccount,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->registry = $registry;
        $this->categoryBuilder = $categoryBuilder;
        $this->nostoHelperAccount = $nostoHelperAccount;
    }

    /**
     * Returns the current category as a slash delimited string
     *
     * @return string the current category as a slash delimited string
     */
    public function getNostoCategory()
    {
        $category = $this->registry->registry('current_category');
        return $this->categoryBuilder->build($category);
    }
}
