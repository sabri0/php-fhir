<?php

/*
 * Copyright 2018-2020 Daniel Carbone (daniel.p.carbone@gmail.com)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/** @var \DCarbone\PHPFHIR\Definition\Type $type */
/** @var \DCarbone\PHPFHIR\Enum\PrimitiveTypeEnum $primitiveType */

ob_start(); ?>
    /**
     * @param null|<?php echo $primitiveType->getPHPValueType(); ?> $value
     * @return static
     */
    public function setValue($value)
    {
        if (null === $value) {
            $this->value = null;
        } else if (is_string($value)) {
            $this->value = $value;
        } else {
            throw new \InvalidArgumentException(sprintf('Value must be null or string, %s seen', gettype($value)));
        }
        return $this;
    }

    /**
     * Will attempt to write the base64-decoded contents of the internal value to the provided file handle
     *
     * @param resource $fileHandle
     * @return int|false
     */
    public function _writeToFile($fileHandle)
    {
        $v = $this->getValue();
        if (null === $v) {
            return 0;
        }
        return fwrite($fileHandle, base64_decode($v));
    }
<?php return ob_get_clean();