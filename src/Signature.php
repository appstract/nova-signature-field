<?php

namespace Appstract\NovaSignatureField;

use Laravel\Nova\Fields\Field;

class Signature extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-signature-field';

    /**
     * Display field in modal.
     */
    public function editInModal($editInModal = true)
    {
        return $this->withMeta(['editInModal' => $editInModal]);
    }

    /**
     * Full width on detail.
     */
    public function fullWidthOnDetail($fullWidthOnDetail = true)
    {
        return $this->withMeta(['fullWidthOnDetail' => $fullWidthOnDetail]);
    }
}
