<?php

namespace Obii\TermsConditions\Forms;

use Obii\Base\Forms\FormAbstract;
use Obii\Base\Enums\BaseStatusEnum;
use Obii\TermsConditions\Http\Requests\TermsConditionsRequest;
use Obii\TermsConditions\Models\TermsConditions;
use RvMedia;

class TermsConditionsForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $this->setupModel(new TermsConditions)
            ->setValidatorClass(TermsConditionsRequest::class)
            ->withCustomFields();

        // Display every attribute from the model with appropriate formatting
        foreach ($this->getModel()->getFillable() as $attribute) {
            $value = $this->getModel()->getAttribute($attribute);
            $castType = $this->getModel()->getCasts()[$attribute] ?? null;
            $labelText = ucwords(str_replace('_', ' ', $attribute));

            // Determine array value based on cast or runtime type
            $arrayValue = null;
            if (in_array($castType, ['array', 'json', 'object'], true)) {
                $arrayValue = is_array($value) ? $value : (array)$value;
            } elseif (is_string($value) && ($decoded = json_decode($value, true)) !== null && json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $arrayValue = $decoded;
            } elseif (is_array($value)) {
                $arrayValue = $value;
            }

            if ($arrayValue !== null) {
                // Render array as HTML table
                $html = '<p><strong>' . e($labelText) . ':</strong></p>';

                // If it is a list of associative arrays, render as data table
                // Attempt to decode JSON string items into arrays
                if (array_is_list($arrayValue) && isset($arrayValue[0]) && is_string($arrayValue[0])) {
                    $decodedItems = collect($arrayValue)->map(function ($item) {
                        $decoded = json_decode($item, true);
                        return json_last_error() === JSON_ERROR_NONE && is_array($decoded) ? $decoded : $item;
                    })->all();
                    // If all items became arrays, replace original
                    if (collect($decodedItems)->every(function ($v) {
                        return is_array($v);
                    })) {
                        $arrayValue = $decodedItems;
                    }
                }

                if (array_is_list($arrayValue) && isset($arrayValue[0]) && is_array($arrayValue[0])) {
                    // Determine headers from rows that are arrays
                    $headers = collect($arrayValue)->filter(fn($v) => is_array($v))->flatMap(function ($item) {
                        return array_keys($item);
                    })->unique()->values()->all();
                    if (empty($headers)) {
                        // Fallback single column
                        $headers = ['value'];
                        $arrayValue = collect($arrayValue)->map(fn($v) => ['value' => $v])->all();
                    }

                    $html .= '<table class="table table-bordered"><thead><tr>';
                    foreach ($headers as $header) {
                        $html .= '<th>' . e(ucwords(str_replace('_', ' ', $header))) . '</th>';
                    }
                    $html .= '</tr></thead><tbody>';

                    foreach ($arrayValue as $row) {
                        $html .= '<tr>';
                        foreach ($headers as $header) {
                            $cell = $row[$header] ?? '';
                            if (is_string($cell) && preg_match('/^https?:\/\//', $cell)) {
                                $cell = '<a href="' . RvMedia::url($cell) . '" target="_blank">' . e(basename($cell)) . '</a>';
                            } elseif (is_array($cell)) {
                                // Try to extract url field
                                if (isset($cell['url'])) {
                                    $linkUrl = RvMedia::url($cell['url']);
                                    $cell = '<a href="' . $linkUrl . '" target="_blank">' . e(basename($cell['url'])) . '</a>';
                                } else {
                                    $cell = e(json_encode($cell));
                                }
                            } else {
                                $cell = e($cell);
                            }
                            $html .= '<td>' . $cell . '</td>';
                        }
                        $html .= '</tr>';
                    }
                    $html .= '</tbody></table>';
                } else {
                    // Simple key/value table
                    $html .= '<table class="table table-bordered">';
                    foreach ($arrayValue as $key => $val) {
                        $html .= '<tr><td>' . e($key) . '</td><td>' . e(is_array($val) ? json_encode($val) : $val) . '</td></tr>';
                    }
                    $html .= '</table>';
                }

                $this->add($attribute, 'html', [
                    'html'  => $html,
                ]);
                continue;
            }

            // Boolean rendering
            if (in_array($castType, ['boolean', 'bool'], true) || is_bool($value) || $value === 1 || $value === 0 || $value === '1' || $value === '0') {
                $display = ($value == true || $value === '1') ? 'Yes' : 'No';
                $this->add($attribute, 'html', [
                    'html' => '<p><strong>' . e($labelText) . ':</strong> ' . $display . '</p>',
                ]);
                continue;
            }

            // File or URL rendering (simple heuristic)
            if (is_string($value) && (preg_match('/^https?:\/\//', $value) || preg_match('/\.(jpg|jpeg|png|gif|pdf|docx?|xlsx?)$/i', $value))) {
                $link = $value;

                $this->add($attribute, 'html', [
                    'label_show' => true,

                    'html' => ': <a href="' . RvMedia::url($link) . '" target="_blank">' . e($link) . '</a>',
                ]);
                continue;
            }

            // Fallback to read-only text
            $this->add($attribute, 'text', [
                'label'      => ucwords(str_replace('_', ' ', $attribute)),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'readonly' => true,
                    'class'    => 'form-control',
                ],
                'value'      => $value,
            ]);
        }

        // Hide action buttons
        $this->setActionButtons('<div></div>');
    }
}
