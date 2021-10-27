<?php

namespace Appstract\NovaSignatureField;

use Laravel\Nova\Fields\Image;
use Illuminate\Support\Facades\Storage;

class SignatureImage extends Image
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-signature-field';

    /**
     * Create a new field.
     *
     * @param  string  $name
     * @param  string|null  $attribute
     * @param  string|null  $disk
     * @param  callable|null  $storageCallback
     * @return void
     */
    public function __construct($name, $attribute = null, $disk = 'public', $storageCallback = null)
    {
        parent::__construct($name, $attribute, $disk, $storageCallback);

        $this->preview(function () {
            if (!$this->value) {
                return null;
            }

            $url = Storage::disk($this->disk)->url($this->value);

            $path_info = pathinfo($url);

            $filetype = 'jpg';

            if (array_key_exists('extension', $path_info)) {
                $filetype = $path_info['extension'];
            }

            try {
                $encoded_file = base64_encode(file_get_contents($url));
            } catch (\Exception $e) {
                return '';
            }

            return 'data:image/' . $filetype . ';base64,' . $encoded_file;
        });
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param string                                  $requestAttribute
     * @param object                                  $model
     * @param string                                  $attribute
     *
     * @return void
     */
    protected function fillAttribute(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        $old_image = $model->{$attribute};

        $image = $request->{$requestAttribute};  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(25).'.'.'png';

        Storage::put($imageName, base64_decode($image));
        Storage::disk($this->disk)->delete($old_image);

        $model->{$attribute} = $imageName;
    }

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

    /**
     * Set the pad height
     */
    public function setPadHeight($padHeight = null)
    {
        return $this->withMeta(['padHeight' => $padHeight]);
    }

    /**
     * Prepare the field for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'thumbnailUrl' => $this->resolveThumbnailUrl(),
            'value' => $this->resolvePreviewUrl(),
            'downloadable' => $this->downloadsAreEnabled && isset($this->downloadResponseCallback) && ! empty($this->value),
            'deletable' => isset($this->deleteCallback) && $this->deletable,
            'acceptedTypes' => $this->acceptedTypes,
        ]);
    }
}
