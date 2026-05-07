<?php

/*
 * CKFinder
 * ========
 * https://ckeditor.com/ckfinder/
 * Copyright (c) 2007-2021, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying or distribute this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 */

namespace CKSource\CKFinder\Filesystem\File;

use CKSource\CKFinder\Backend\Backend;
use CKSource\CKFinder\CKFinder;
use CKSource\CKFinder\Error;
use CKSource\CKFinder\Exception\AccessDeniedException;
use CKSource\CKFinder\Exception\InvalidUploadException;
use CKSource\CKFinder\Filesystem\Folder\WorkingFolder;
use CKSource\CKFinder\Utils;
use Symfony\Component\HttpFoundation\File\UploadedFile as UploadedFileBase;
use Symfony\Component\Mime\MimeTypes;

/**
 * The UploadedFile class.
 *
 * Represents uploaded file
 */
class UploadedFile extends File
{
    /**
     * A Symfony UploadedFile object.
     *
     * @var UploadedFileBase
     */
    protected $uploadedFile;

    /**
     * A WorkingFolder object pointing to the folder where the file is uploaded.
     *
     * @var WorkingFolder
     */
    protected $workingFolder;

    /**
     * Temporary path for the uploaded file.
     *
     * @var string
     */
    protected $tempFilePath;

    /**
     * Constructor.
     *
     * @throws \Exception if file upload failed
     */
    public function __construct(UploadedFileBase $uploadedFile, CKFinder $app)
    {
        parent::__construct($uploadedFile->getClientOriginalName(), $app);

        $this->uploadedFile = $uploadedFile;
        $this->workingFolder = $app['working_folder'];

        $this->tempFilePath = tempnam($this->config->get('tempDirectory'), 'ckf');
        $pathinfo = pathinfo($this->tempFilePath);

        if (!is_writable($this->tempFilePath)) {
            throw new InvalidUploadException('The temporary folder is not writable for CKFinder');
        }

        try {
            $uploadedFile->move($pathinfo['dirname'], $pathinfo['basename']);
        } catch (\Exception $e) {
            $errorMessage = $uploadedFile->getErrorMessage();
            switch ($uploadedFile->getError()) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new InvalidUploadException($errorMessage, Error::UPLOADED_TOO_BIG, [], $e);
                case UPLOAD_ERR_PARTIAL:
                case UPLOAD_ERR_NO_FILE:
                    throw new InvalidUploadException($errorMessage, Error::UPLOADED_CORRUPT, [], $e);
                case UPLOAD_ERR_NO_TMP_DIR:
                    throw new InvalidUploadException($errorMessage, Error::UPLOADED_NO_TMP_DIR, [], $e);
                case UPLOAD_ERR_CANT_WRITE:
                case UPLOAD_ERR_EXTENSION:
                    throw new AccessDeniedException($errorMessage, [], $e);
            }
        }
    }

    /**
     * Destructor: Removes the temporary file, if required.
     */
    public function __destruct()
    {
        if (file_exists($this->tempFilePath)) {
            unlink($this->tempFilePath);
        }
    }

    /**
     * Checks if the file was uploaded properly.
     *
     * @return bool `true` if upload is valid
     */
    public function isValid()
    {
        return $this->uploadedFile && $this->tempFilePath && is_readable($this->tempFilePath) && is_writable($this->tempFilePath);
    }

    /**
     * Sanitizes current file name using options set in Config.
     */
    public function sanitizeFilename()
    {
        $this->fileName = static::secureName(
            $this->fileName,
            $this->config->get('disallowUnsafeCharacters'),
            $this->config->get('forceAscii')
        );

        if($this->config->get('forceAscii')){
            //Создаем массив с буквами с нижнем регистре
            $lower_str=array(
            'à' => 'a', 'ô' => 'o', 'ď' => 'd', 'ḟ' => 'f', 'ë' => 'e', 'š' => 's', 'ơ' => 'o',
            'ß' => 'ss', 'ă' => 'a', 'ř' => 'r', 'ț' => 't', 'ň' => 'n', 'ā' => 'a', 'ķ' => 'k',
            'ŝ' => 's', 'ỳ' => 'y', 'ņ' => 'n', 'ĺ' => 'l', 'ħ' => 'h', 'ṗ' => 'p', 'ó' => 'o',
            'ú' => 'u', 'ě' => 'e', 'é' => 'e', 'ç' => 'c', 'ẁ' => 'w', 'ċ' => 'c', 'õ' => 'o',
            'ṡ' => 's', 'ø' => 'o', 'ģ' => 'g', 'ŧ' => 't', 'ș' => 's', 'ė' => 'e', 'ĉ' => 'c',
            'ś' => 's', 'î' => 'i', 'ű' => 'u', 'ć' => 'c', 'ę' => 'e', 'ŵ' => 'w', 'ṫ' => 't',
            'ū' => 'u', 'č' => 'c', 'ö' => 'oe', 'è' => 'e', 'ŷ' => 'y', 'ą' => 'a', 'ł' => 'l',
            'ų' => 'u', 'ů' => 'u', 'ş' => 's', 'ğ' => 'g', 'ļ' => 'l', 'ƒ' => 'f', 'ž' => 'z',
            'ẃ' => 'w', 'ḃ' => 'b', 'å' => 'a', 'ì' => 'i', 'ï' => 'i', 'ḋ' => 'd', 'ť' => 't',
            'ŗ' => 'r', 'ä' => 'ae', 'í' => 'i', 'ŕ' => 'r', 'ê' => 'e', 'ü' => 'ue', 'ò' => 'o',
            'ē' => 'e', 'ñ' => 'n', 'ń' => 'n', 'ĥ' => 'h', 'ĝ' => 'g', 'đ' => 'd', 'ĵ' => 'j',
            'ÿ' => 'y', 'ũ' => 'u', 'ŭ' => 'u', 'ư' => 'u', 'ţ' => 't', 'ý' => 'y', 'ő' => 'o',
            'â' => 'a', 'ľ' => 'l', 'ẅ' => 'w', 'ż' => 'z', 'ī' => 'i', 'ã' => 'a', 'ġ' => 'g',
            'ṁ' => 'm', 'ō' => 'o', 'ĩ' => 'i', 'ù' => 'u', 'į' => 'i', 'ź' => 'z', 'á' => 'a',
            'û' => 'u', 'þ' => 'th', 'ð' => 'dh', 'æ' => 'ae', 'µ' => 'u', 'ĕ' => 'e',
            'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'yo','ж'=>'zh','з'=>'z','и'=>'i','й'=>'y',
            'к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f',
            'х'=>'h','ц'=>'ts','ч'=>'ch','ш'=>'sh','щ'=>'shch','ъ'=>'','ы'=>'i','ь'=>'','э'=>'e','ю'=>'yu','я'=>'ya',
            'ґ'=>'g','є'=>'e','і'=>'i','ї'=>'i',
            );
            //Создаем массив с буквами с верхнем регистре
            $upper_str = array(
            'À' => 'A', 'Ô' => 'O', 'Ď' => 'D', 'Ḟ' => 'F', 'Ë' => 'E', 'Š' => 'S', 'Ơ' => 'O',
            'Ă' => 'A', 'Ř' => 'R', 'Ț' => 'T', 'Ň' => 'N', 'Ā' => 'A', 'Ķ' => 'K',
            'Ŝ' => 'S', 'Ỳ' => 'Y', 'Ņ' => 'N', 'Ĺ' => 'L', 'Ħ' => 'H', 'Ṗ' => 'P', 'Ó' => 'O',
            'Ú' => 'U', 'Ě' => 'E', 'É' => 'E', 'Ç' => 'C', 'Ẁ' => 'W', 'Ċ' => 'C', 'Õ' => 'O',
            'Ṡ' => 'S', 'Ø' => 'O', 'Ģ' => 'G', 'Ŧ' => 'T', 'Ș' => 'S', 'Ė' => 'E', 'Ĉ' => 'C',
            'Ś' => 'S', 'Î' => 'I', 'Ű' => 'U', 'Ć' => 'C', 'Ę' => 'E', 'Ŵ' => 'W', 'Ṫ' => 'T',
            'Ū' => 'U', 'Č' => 'C', 'Ö' => 'Oe', 'È' => 'E', 'Ŷ' => 'Y', 'Ą' => 'A', 'Ł' => 'L',
            'Ų' => 'U', 'Ů' => 'U', 'Ş' => 'S', 'Ğ' => 'G', 'Ļ' => 'L', 'Ƒ' => 'F', 'Ž' => 'Z',
            'Ẃ' => 'W', 'Ḃ' => 'B', 'Å' => 'A', 'Ì' => 'I', 'Ï' => 'I', 'Ḋ' => 'D', 'Ť' => 'T',
            'Ŗ' => 'R', 'Ä' => 'Ae', 'Í' => 'I', 'Ŕ' => 'R', 'Ê' => 'E', 'Ü' => 'Ue', 'Ò' => 'O',
            'Ē' => 'E', 'Ñ' => 'N', 'Ń' => 'N', 'Ĥ' => 'H', 'Ĝ' => 'G', 'Đ' => 'D', 'Ĵ' => 'J',
            'Ÿ' => 'Y', 'Ũ' => 'U', 'Ŭ' => 'U', 'Ư' => 'U', 'Ţ' => 'T', 'Ý' => 'Y', 'Ő' => 'O',
            'Â' => 'A', 'Ľ' => 'L', 'Ẅ' => 'W', 'Ż' => 'Z', 'Ī' => 'I', 'Ã' => 'A', 'Ġ' => 'G',
            'Ṁ' => 'M', 'Ō' => 'O', 'Ĩ' => 'I', 'Ù' => 'U', 'Į' => 'I', 'Ź' => 'Z', 'Á' => 'A',
            'Û' => 'U', 'Þ' => 'Th', 'Ð' => 'Dh', 'Æ' => 'Ae', 'Ĕ' => 'E',
            'А'=>'A','Б'=>'B','В'=>'V','Г'=>'G','Д'=>'D','Е'=>'E','Ё'=>'Yo','Ж'=>'Zh','З'=>'Z','И'=>'I','Й'=>'Y',
            'К'=>'K','Л'=>'L','М'=>'M','Н'=>'N','О'=>'O','П'=>'P','Р'=>'R','С'=>'S','Т'=>'T','У'=>'U','Ф'=>'F',
            'Х'=>'H','Ц'=>'Ts','Ч'=>'CH','Ш'=>'Sh','Щ'=>'Shch','Ъ'=>'','Ы'=>'I','Ь'=>'','Э'=>'E','Ю'=>'Yu','Я'=>'Ya',
            'Ґ'=>'g','Є'=>'e','І'=>'i','Ї'=>'i','№'=>'no_',
            );
            // Замена маленьких букв
            $this->fileName=str_replace(
            array_keys($lower_str),
            array_values($lower_str),
            $this->fileName
            );
            // Замена заглавных букв
            $this->fileName=str_replace(
            array_keys($upper_str),
            array_values($upper_str),
            $this->fileName
            );
            // Ставим дополнительный фильтр для спец символов
            $this->fileName=preg_replace(
            array(
            '/[&]/', // амперсанды
            '/[\s]/', // пробелы
            '/[^a-z_\.\d\(\)-]/i', // все кроме допустимых символов (английский алфавит, цифры, тире и нижнее подчеркивание)
            ),
            array(
            'and',
            '_',
            '',
            ),
            $this->fileName
            );
           }

        $resourceType = $this->workingFolder->getResourceType();

        if ($this->config->get('checkDoubleExtension')) {
            $this->fileName = Utils::replaceDisallowedExtensions($this->fileName, $resourceType);
        }
    }

    /**
     * Checks if the file extension is allowed in the target folder.
     *
     * @return bool `true` if an extension is allowed in the target folder
     */
    public function hasAllowedExtension()
    {
        $ext = false === strpos($this->fileName, '.')
            ? null
            : $this->getExtension();

        return $this->workingFolder->getResourceType()->isAllowedExtension($ext);
    }

    /**
     * @copydoc File::autorename()
     *
     * @param mixed $path
     */
    public function autorename(Backend $backend = null, $path = '')
    {
        return parent::autorename($this->workingFolder->getBackend(), $this->workingFolder->getPath());
    }

    /**
     * Checks if the file was renamed.
     *
     * @return bool `true` if the file was renamed
     */
    public function wasRenamed()
    {
        return $this->fileName !== $this->uploadedFile->getClientOriginalName();
    }

    /**
     * Check if the current file name is defined as hidden in configuration settings.
     *
     * @return bool `true` if the file name is hidden
     */
    public function isHiddenFile()
    {
        return $this->workingFolder->getBackend()->isHiddenFile($this->fileName);
    }

    /**
     * Returns the upload error.
     *
     * If the upload was successful, the `UPLOAD_ERR_OK` constant is returned.
     * Otherwise one of the other `UPLOAD_ERR_XXX` constants is returned.
     *
     * @return int upload error
     */
    public function getError()
    {
        return $this->uploadedFile->getError();
    }

    /**
     * Returns the upload error message.
     *
     * @return string upload error
     */
    public function getErrorMessage()
    {
        return $this->uploadedFile->getErrorMessage();
    }

    /**
     * Returns uploaded file contents.
     *
     * @return string uploaded file data
     */
    public function getContents()
    {
        return file_get_contents($this->tempFilePath);
    }

    /**
     * Returns contents stream for the uploaded file.
     *
     * @return resource
     */
    public function getContentsStream()
    {
        return fopen($this->tempFilePath, 'r');
    }

    /**
     * Returns uploaded file size in bytes.
     *
     * @return int file size in bytes
     */
    public function getSize()
    {
        clearstatcache();

        return filesize($this->tempFilePath);
    }

    /**
     * Returns uploaded file MIME type.
     *
     * @return string
     */
    public function getMimeType()
    {
        return MimeTypes::getDefault()->guessMimeType($this->tempFilePath);
    }

    /**
     * Detects HTML in the first KB to prevent against a potential security issue with
     * IE/Safari/Opera file type auto detection bug.
     * Returns `true` if a file contains insecure HTML code at the beginning.
     *
     * @return bool `true` if the uploaded file contains HTML in the first 1024 bytes
     */
    public function containsHtml()
    {
        $fp = fopen($this->tempFilePath, 'r');
        $chunk = fread($fp, 1024);
        fclose($fp);

        return Utils::containsHtml($chunk);
    }

    /**
     * Checks if a file with the current extension is allowed to contain any HTML/JS.
     *
     * @return bool `true` if a file is allowed to contain HTML chunks
     */
    public function isAllowedHtmlFile()
    {
        return \in_array(strtolower($this->getExtension()), $this->config->get('htmlExtensions'), true);
    }

    /**
     * Checks if the file is a valid image.
     *
     * Internally `getimagesize` is used for validation.
     *
     * @return bool `true` if the file is a valid image
     */
    public function isValidImage()
    {
        if (false === @getimagesize($this->tempFilePath)) {
            return false;
        }

        return true;
    }

    /**
     * Saves the data as new file contents.
     *
     * @param string $data new file contents
     */
    public function save($data)
    {
        file_put_contents($this->tempFilePath, $data);
    }
}
