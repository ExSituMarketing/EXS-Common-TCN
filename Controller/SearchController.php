<?php

namespace exs\TcnCommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SearchController
 * @package exs\TcnCommonBundle\Controller
 */
class SearchController extends Controller
{
    /**
     * @return Response
     */
    public function allProductsAction()
    {
        $data = $this->get('tcn.data.service')->getAllData();

        $response = new Response();
        $response->setContent(
            'var data=' . \json_encode($this->formatdataForSearch($data)) . ';'
        );
        return $response;
    }

    public function formatdataForSearch($data = array())
    {
        $formatted = [];
        foreach ($data['products'] as $product) {
            if($product->getName()){
                //site has a review and a category
                if (strlen($product->getOverview()) > 0 && $product->getCategory()) {
                    // generate review url
                    $link = $this->generateUrl('exsitu_tcn_common_review',
                        [
                            'categorySlug' => $product->getCategory()->getSlug(),
                            'reviewSlug' => $product->getSlug()
                        ],
                        true
                    );
                } else {
                    // else generate tourlink url
                    $link = $product->getTourLink();
                }

                $formatted[] = [
                    'name' => $product->getName(),
                    'link' => $link,
                    'icon' => $product->getName()//$product->getIcon(),
                ];
            }
        }
        return $formatted;
    }
}
