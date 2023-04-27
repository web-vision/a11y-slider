<?php

declare(strict_types = 1);

namespace WebVision\A11ySlider\DataProcessing;

use TYPO3\CMS\Core\Imaging\ImageManipulation\CropVariantCollection;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Frontend\ContentObject\Exception\ContentRenderingException;

class SliderProcessor implements DataProcessorInterface
{
    /**
     * Process data for the CType "wv_slider"
     *
     * @param ContentObjectRenderer $cObj The content object renderer, which contains data of the content element
     * @param array[] $contentObjectConfiguration The configuration of Content Object
     * @param array[] $processorConfiguration The configuration of this processor
     * @param array[] $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array[]<data: array, current: boolean, files: array, slider: array> the processed data as key/value store
     * @throws ContentRenderingException
     */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        // Calculating the total width of the slider
        // $sliderWidth = 0;
        // if ((int)$processedData['data']['imagewidth'] > 0) {
        //     $sliderWidth = (int)$processedData['data']['imagewidth'];
        // } else {
        // $files = $processedData['files'];
        // /** @var \TYPO3\CMS\Core\Resource\FileReference $file */
        // foreach ($files as $file) {
        //     $fileWidth = $this->getCroppedWidth($file);
        //     // $sliderWidth = $fileWidth > $sliderWidth ? $fileWidth : $sliderWidth;
        // }
        // }
        // This will be available in fluid with {slider.options}
        $processedData['slider']['options'] = $this->getOptionsFromFlexFormData($processedData['data']);
        // This will be available in fluid with {slider.width}
        $processedData['slider']['width'] =  $processedData['data']['imagewidth'];
        $processedData['slider']['height'] = $processedData['data']['imageheight'];
        return $processedData;
    }

    protected function getCroppedWidth(FileInterface $fileObject): string
    {
        if (!$fileObject->hasProperty('crop') || empty($fileObject->getProperty('crop'))) {
            return $fileObject->getProperty('width');
        }

        $cropString = $fileObject->getProperty('crop');
        $croppingConfiguration = json_decode($cropString, true);

        $cropVariantCollection = CropVariantCollection::create((string)$cropString);
        $width = '0';
        foreach (array_keys($croppingConfiguration) as $cropVariant) {
            $cropArea = $cropVariantCollection->getCropArea((string)$cropVariant);
            if ($cropArea->isEmpty()) {
                continue;
            }
            $cropResult = json_decode((string)$cropArea->makeAbsoluteBasedOnFile($fileObject), true);
            if (!empty($cropResult['width']) && (int)$cropResult['width'] > $width) {
                $width = (int)$cropResult['width'];
            }
        }
        return $width;
    }

    /**
     * @param array<string> $row
     * @return array[] slider options
     */
    protected function getOptionsFromFlexFormData(array $row): array
    {
        $options = [];
        $flexFormService = GeneralUtility::makeInstance(FlexFormService::class);
        $flexFormAsArray = $flexFormService->convertFlexFormContentToArray($row['pi_flexform']);
        foreach ($flexFormAsArray['options'] as $optionKey => $optionValue) {
            switch ($optionValue) {
                case '1':
                    $options[$optionKey] = true;
                    break;
                case '0':
                    $options[$optionKey] = false;
                    break;
                default:
                    $options[$optionKey] = $optionValue;
            }
        }
        return $options;
    }
}
