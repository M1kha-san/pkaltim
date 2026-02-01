<?php
/**
 * Language Helper
 * Multi-language support system with database-driven translations
 */

class Language {
    private static $currentLang = 'id'; // Default: Indonesian
    private static $translations = [];
    private static $db = null;
    
    /**
     * Initialize language system
     */
    public static function init() {
        // Get database connection
        self::$db = Database::getInstance()->getConnection();
        
        // Check session for saved language
        if (isset($_SESSION['language'])) {
            self::$currentLang = $_SESSION['language'];
        } 
        // Check cookie as fallback
        elseif (isset($_COOKIE['language'])) {
            self::$currentLang = $_COOKIE['language'];
            $_SESSION['language'] = self::$currentLang;
        }
        
        // Load translations from database
        self::loadTranslations();
    }
    
    /**
     * Load all translations for current language
     */
    private static function loadTranslations() {
        if (!self::$db) {
            return;
        }
        
        try {
            $sql = "SELECT translation_key, translation_value 
                    FROM translations 
                    WHERE lang_code = :lang_code";
            
            $stmt = self::$db->prepare($sql);
            $stmt->bindValue(':lang_code', self::$currentLang, PDO::PARAM_STR);
            $stmt->execute();
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($results as $row) {
                self::$translations[$row['translation_key']] = $row['translation_value'];
            }
        } catch (PDOException $e) {
            // Silent fail - table might not exist yet
            error_log("Translation loading failed: " . $e->getMessage());
        }
    }
    
    /**
     * Get translation by key
     */
    public static function get($key, $default = null) {
        if (isset(self::$translations[$key])) {
            return self::$translations[$key];
        }
        
        return $default ?? $key;
    }
    
    /**
     * Set current language
     */
    public static function setLanguage($lang_code) {
        $allowed = ['id', 'en'];
        
        if (!in_array($lang_code, $allowed)) {
            return false;
        }
        
        self::$currentLang = $lang_code;
        $_SESSION['language'] = $lang_code;
        
        // Set cookie for 30 days
        setcookie('language', $lang_code, time() + (30 * 24 * 60 * 60), '/');
        
        // Reload translations
        self::$translations = [];
        self::loadTranslations();
        
        return true;
    }
    
    /**
     * Get current language code
     */
    public static function getCurrentLanguage() {
        return self::$currentLang;
    }
    
    /**
     * Alias for get() - shorter syntax
     */
    public static function t($key, $default = null) {
        return self::get($key, $default);
    }
}
