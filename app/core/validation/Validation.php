<?php
namespace app\core\validation;

require 'vendor/autoload.php'; // Include the Composer autoload file

use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;

use app\core\DB;

/**
 * Validation
 */
class Validation
{

    /**
     * errors
     *
     * @var array
     */
    public static $errors = array();

    /**
     * validationError
     *
     * @var array
     */
    public static $validationError = array();

    /**
     * validate
     *
     * @param  array $rules
     * @param  array $request
     * @param  array $msgs
     * @return array|bool
     */
    public static function validate($rules, $request, $msgs = [])
    {
        $data = $request; // passing all request into data array

        $validatedData = []; // multi request array (.*)

        // rules foreach loop
        foreach ($rules as $field => $ruleString) {

            // multiinput validation
            $fieldParts = explode('.', $field) ?? false;            

            // check if field key have .*
            if (count($fieldParts) === 2) {                   

                $getFieldNameOrg = $getFieldName = $fieldParts[0];   // passing value                                

                // single form fields                
                if (in_array($getFieldName, array_keys($data))) {
                    
                    // making input field with name[increment]
                    for ($increment = 0; $increment < count($data[$getFieldNameOrg]) ; $increment++) {                        
                        
                        $validatedData[$getFieldNameOrg.$increment] = $data[$getFieldNameOrg][$increment];
                    }

                    /**
                     * applyValidation
                     *
                     * @param  mixed $ruleString
                     * @param  array $data
                     * @param  mixed $field
                     * @param  array $msgs
                     * @return array|bool
                     */
                     for ($increment = 0; $increment < count($data[$getFieldNameOrg]) ; $increment++) {                        
                        $getFieldName = $getFieldNameOrg.$increment;     
                        self::applyValidation($ruleString,$validatedData,$getFieldName,$msgs);
                     }
                    
                }
            } else {
                        
                // single form fields
                if (in_array($field, array_keys($data))) {               
                    
                    /**
                     * applyValidation
                     *
                     * @param  mixed $ruleString
                     * @param  array $data
                     * @param  mixed $field
                     * @param  array $msgs
                     * @return array|bool
                     */
                    self::applyValidation($ruleString,$data,$field,$msgs);
                }
            }
        }
    }
    
    /**
     * getErrors
     *
     * @return array|bool
     */
    public static function getErrors() {
        
        return empty(self::$errors) ? true : self::$errors;
    }

    /**
     * applyValidation
     *
     * @param  mixed $ruleString
     * @param  array $data
     * @param  mixed $field
     * @param  array $msgs
     * @return void|array
     */
    protected static function applyValidation($ruleString,$data,$field, $msgs = array())
    {
        $rules = explode('|', $ruleString);
        foreach ($rules as $rule) {

            $ruleParts = explode(':', $rule);

            $ruleName = $ruleParts[0];
            $ruleValue = isset($ruleParts[1]) ? $ruleParts[1] : null;
            if($ruleValue) {
                $getTableContent = explode('.', $ruleValue);
                $table = isset($getTableContent[0]) ? $getTableContent[0] : null;
                $column = isset($getTableContent[1]) ? $getTableContent[1] : null;
            }

            $isArray = !empty(explode('.', $field)[1]) ? '.*' : $field;
            $valid = true;
            $exceptionMsg = '';
            
            switch ($ruleName) {
                case 'required':
                    $valid = !empty(trim($data[$field])) && $data[$field] !== '';

                    if (!$valid) {
                        $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                        if (empty(self::$validationError[$field])) {
                            self::$validationError[$field] = $fieldMsg . " field must be " . $ruleName;
                        }
                    }
                    break;

                case 'array_required':
                    if (!empty($data[$field])) {
                        $nonEmptyElements = !empty($data[$field]) ? array_filter($data[$field], 'strlen') : [];

                        $valid = (empty($nonEmptyElements)) ? false : true;
                    }

                    if (!$valid) {
                        $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                        if (empty(self::$validationError[$field])) {
                            self::$validationError[$field] = $fieldMsg . " is empty or contains only empty elements.";
                        }
                    }
                    break;

                case 'max':
                    if (!empty($data[$field])) {
                        $valid = is_numeric($data[$field]) ? $data[$field] <= $ruleValue : mb_strlen($data[$field]) <= $ruleValue;
                    }
                    if (!$valid) {
                        $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                        if (empty(self::$validationError[$field])) {
                            self::$validationError[$field] = $fieldMsg . " field must be less than " . $ruleValue;
                        }
                    }

                    break;

                case 'min':
                    if (!empty($data[$field])) {
                        $valid = is_numeric($data[$field]) ? $data[$field] >= $ruleValue : mb_strlen($data[$field]) >= $ruleValue;
                    }
                    if (!$valid) {
                        $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                        if (empty(self::$validationError[$field])) {
                            self::$validationError[$field] = $fieldMsg . " field must be greater than " . $ruleValue;
                        }
                    }

                    break;

                case 'numeric':

                    if (!empty($data[$field])) {
                        $valid = is_numeric($data[$field]);
                    }

                    if (!$valid) {

                        $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                        if (empty(self::$validationError[$field])) {
                            self::$validationError[$field] = $fieldMsg . " field must be " . $ruleName;
                        }
                    }
                    break;

                case 'equals':
                    if (!empty($data[$field]) || !empty($ruleValue)) {                        
                        
                        if ($data[$field] !== $ruleValue) {
                            $valid = false;
                        }
                        
                        if (!$valid) {
                            $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                            self::$validationError[$field] = $fieldMsg . " doesn't matched ";
                        }

                    }
                    
                    break;

                case 'decimal':
                    if (!empty($data[$field])) {
                        $valid = (is_numeric($data[$field]) && preg_match('/^\d+(\.\d{1,' . $ruleValue . '})?$/', $data[$field])) ? true : false;
                    }
                    if (!$valid) {
                        $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                        if (empty(self::$validationError[$field])) {
                            self::$validationError[$field] = $fieldMsg . " field must be under " . $ruleValue . " decimal value";
                        }
                    }
                    break;

                case 'string':
                    if (!empty($data[$field])) {
                        $valid = preg_match("/^[A-Za-z\s]+$/", $data[$field]);
                    }
                    if (!$valid) {
                        $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;

                        if (empty(self::$validationError[$field])) {
                            self::$validationError[$field] = $fieldMsg . " field must be " . $ruleName;
                        }
                    }
                    break;

                case 'phone':


                    $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;

                    if (!empty($data[$field]) && is_numeric($data[$field])) {

                        $phoneNumberUtil = PhoneNumberUtil::getInstance();

                        // Phone number and country code to validate
                        $phoneNumber = $data[$field];
                        $countryCode = $data['phone_code'] ?? 'IN'; // Replace with the country code you want to validate against (e.g., US for United States)


                        try {
                            // Parse the phone number with the provided country code
                            $numberProto = $phoneNumberUtil->parse($phoneNumber, $countryCode);

                            // Check if the phone number is valid for the specified country
                            if ($phoneNumberUtil->isValidNumberForRegion($numberProto, $countryCode)) {
                                // Format the phone number in E.164 format
                                $formattedNumber = $phoneNumberUtil->format($numberProto, PhoneNumberFormat::E164);
                                $valid = true;
                            } else {
                                $valid = false;
                                if (empty(self::$validationError[$field])) {
                                    self::$validationError[$field] = "Invalid " . $fieldMsg . " for the (" . $countryCode . ") country.";
                                }
                            }
                        } catch (\libphonenumber\NumberFormatException $e) {
                            $valid = false;
                            if (empty(self::$validationError[$field])) {
                                self::$validationError[$field] = "Invalid " . $fieldMsg . "format: " . $e->getMessage();
                            }
                        }
                    }

                    break;

                case 'str_max':
                    if (!empty($data[$field])) {
                        $string_length = \utf8_strlen($data[$field]);
                        $valid = ($string_length > $ruleValue) ? false : true;
                    }

                    if (!$valid) {
                        $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                        if (empty(self::$validationError[$field])) {
                            self::$validationError[$field] = $fieldMsg . " field must be less than " . $ruleValue;
                        }
                    }
                    break;

                case 'str_min':
                    if (!empty($data[$field])) {
                        $string_length = \utf8_strlen($data[$field]);
                        $valid = ($string_length < $ruleValue) ? false : true;
                    }

                    if (!$valid) {
                        $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                        if (empty(self::$validationError[$field])) {
                            self::$validationError[$field] = $fieldMsg . " field must be less than " . $ruleValue;
                        }
                    }
                    break;

                case 'unique':
                    if (!empty($data[$field])) {
                        $vals = trim($data[$field]);
                        $data[$field] = preg_replace('/\s+/', ' ', $vals);

                        $sql = '';
                        $sql .= 'SELECT count(' . $column . ')  as count';
                        $sql .= ' FROM ' . $table;
                        $sql .= ' WHERE ' . $column . ' = "' . $data[$field] . '"';
                    }

                    try {
                        if (!empty($data[$field])) {
                            
                            $valid = !DB::get()->get->query($sql)->fetch_assoc()['count'];
                        }

                        if (!$valid) {
                            $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                            if (empty(self::$validationError[$field])) {
                                self::$validationError[$field] = $fieldMsg . " field must be " . $ruleName;
                            }
                        }
                    } catch (\Exception $e) {
                        $valid = false;
                        $exceptionMsg = $e->getMessage();
                    }
                    break;

                case 'not_in':
                    if (!empty($data[$field])) {
                        $vals = trim($data[$field]);
                        $data[$field] = preg_replace('/\s+/', ' ', $vals);
                        
                        $not = explode('-',explode(',',$column)[1])[0] ?? '';
                        $notValue = explode('-',explode(',',$column)[1])[1] ?? '';
                        if(!empty($not) && !empty($notValue)) {
                            $column = explode(',',$column)[0] ?? $column;
                        }
                        $sql = '';
                        $sql .= 'SELECT count(' . $column . ')  as count';
                        $sql .= ' FROM ' . $table;
                        $sql .= ' WHERE ' . $column . ' = "' . $data[$field] . '"';
                        if(!empty($not) && !empty($notValue)) {
                            $sql .= ' AND `'.$not.'` != "'.$notValue.'"';
                        }
                    }

                    try {
                        if (!empty($data[$field])) {
                            $valid = !DB::get()->get->query($sql)->fetch_assoc()['count'];
                        }

                        if (!$valid) {
                            $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                            if (empty(self::$validationError[$field])) {
                                self::$validationError[$field] = $fieldMsg . " field must be " . $ruleName;
                            }
                        }
                    } catch (\Exception $e) {
                        $valid = false;
                        $exceptionMsg = $e->getMessage();
                    }
                    break;

                case 'in':
                    if (!empty($data[$field])) {
                        $keys = !empty($data[$field]) ? $data[$field] : 0;
                        if (is_array($keys)) {
                            $keys = implode(',', $keys);
                        }
                        $sql = '';
                        $sql .= 'SELECT count(' . $column . ')  as count';
                        $sql .= ' FROM ' . $table;
                        $sql .= ' WHERE ' . $column . ' IN ("' . $keys . '")';
                    }

                    try {
                        if (!empty($data[$field])) {
                            $valid = DB::get()->get->query($sql)->fetch_assoc()['count'];
                        }

                        if (!$valid) {
                            $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                            if (empty(self::$validationError[$field])) {
                                self::$validationError[$field] = $fieldMsg . " not exists.";
                            }
                        }
                    } catch (\Exception $e) {
                        $valid = false;
                        $exceptionMsg = $e->getMessage();
                    }
                    break;

                case 'assign':
                    if (!empty($data[$field])) {
                        $keys = !empty($data[$field]) ? $data[$field] : 0;
                        if (is_array($keys)) {
                            $keys = implode(',', $keys);
                        }
                        $sql = '';
                        $sql .= 'SELECT count(' . $column . ')  as count';
                        $sql .= ' FROM ' . $table;
                        $sql .= ' WHERE ' . $column . ' IN ("' . $keys . '")';
                    }

                    try {
                        if (!empty($data[$field])) {
                            $valid = DB::get()->get->query($sql)->fetch_assoc()['count'];
                        }
                        if ($valid) {
                            $valid = false;                            
                            $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                            
                            if (empty(self::$validationError[$field])) {
                            
                                self::$validationError[$field] = $fieldMsg . " already in used";
                            }
                        }
                    } catch (\Exception $e) {
                        
                        $valid = false;
                        $exceptionMsg = $e->getMessage();
                    }
                    break;

                case 'rgex':
                    if (!empty($data[$field])) {
                        $valid = preg_match($ruleValue, $data[$field]);
                    }
                    if (!$valid) {
                        $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                        if (empty(self::$validationError[$field])) {
                            self::$validationError[$field] = $fieldMsg . " field must be match with " . $ruleValue;
                        }
                    }
                    break;

                case 'url':

                    // Define a regular expression pattern to match the desired URLs
                    $pattern = '/^(https?:\/\/)?(www\.)?google\.com/i';
                    if (!empty($data[$field])) {
                        // Use preg_match to check if the URL matches the pattern
                        $valid = preg_match($pattern, $data[$field]);
                    }

                    if (!$valid) {
                        $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                        if (empty(self::$validationError[$field])) {
                            self::$validationError[$field] = $fieldMsg . " must be validated";
                        }
                    }
                    break;

                case 'email':
                    // Define a regular expression pattern for email validation
                    $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
                    if (!empty($data[$field])) {
                        $valid = preg_match($emailPattern, $data[$field]);
                    }
                    if (!$valid) {
                        $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                        if (empty(self::$validationError[$field])) {
                            self::$validationError[$field] = $fieldMsg . " must be validated";
                        }
                    }

                    break;

                case 'file':
                    if (!empty($data[$field])) {
                        $fileValidation = explode('&', $ruleValue);
                        $imagErrors = [];
                        foreach ($fileValidation as $irule) {
                            $iruleParts = explode('.', $irule);

                            $iruleName = $iruleParts[0];

                            $iruleValue = isset($iruleParts[1]) ? $iruleParts[1] : null;

                            $errorMsg = self::_imageValidate($iruleName, [$iruleName => $data[$field][$iruleName]], $iruleValue, $field);
                            if ($errorMsg) {
                                $imagErrors[$field][$iruleName] = $errorMsg;
                            }
                        }
                    }

                    $nonEmptyElements = !empty($imagErrors[$field]) ? array_filter($imagErrors[$field], 'strlen') : [];

                    $valid = empty($nonEmptyElements) ? true : false;

                    if (!$valid) {
                        self::$validationError = array_merge(self::$validationError, $imagErrors);
                    }

                    break;
                case '.*':

                    break;
                
                case 'in_array':

                    if (!empty($data[$field])) {                        

                        if (!in_array($data[$field], explode(',', $ruleValue))) {
                            $valid = false;
                        }
                        
                        if (!$valid) {
                            $fieldMsg = isset($msgs[$field]) ? $msgs[$field] : $field;
                            self::$validationError[$field] = $fieldMsg . " must be in ".$ruleValue;
                        }

                    }

                    break;
                default:
                    // Custom rule handling here
                    break;
            }

            if (!$valid) {
                if (!$exceptionMsg) {
                    self::$errors = self::$validationError;
                } else {
                    self::$errors[] = $exceptionMsg;
                }
            }
        }
    }

    /**
     * _imageValidate
     *
     * @param  mixed $rulname
     * @param  array $data
     * @param  mixed $ruleValue
     * @param  mixed $key
     * @return array|string
     */
    private static function _imageValidate($rulname, $data = array(), $ruleValue = '', $key = '')
    {
        $valid = true;

        switch ($rulname) {
            case 'size':
                if ($data[$rulname] > $ruleValue) {
                    $valid = false;
                }

                if (!$valid) {
                    $sizeRequired = number_format($ruleValue / 1048576, 2) . ' MB';

                    return $key . " " . $rulname . " must be less then " . $sizeRequired;
                }

                break;

            case 'in_array':

                if (!in_array($data[$rulname], explode(',', $ruleValue))) {
                    $valid = false;
                }

                if (!$valid) {
                    return $key . " " . $rulname . " must be " . $ruleValue;
                }

                break;

            case 'type':

                if (!in_array($data[$rulname], explode(',', $ruleValue))) {
                    $valid = false;
                }

                if (!$valid) {
                    return $key . " " . $rulname . " must be " . $ruleValue;
                }

                break;

            case 'name':
                $extension = pathinfo($data[$rulname], PATHINFO_EXTENSION);
                if (!in_array($extension, explode(',', $ruleValue))) {
                    $valid = false;
                }

                if (!$valid) {
                    return $key . " extension" . " must be " . $ruleValue;
                }

                break;

            default:
                // Custom rule handling here
                break;
        }
    }
}
