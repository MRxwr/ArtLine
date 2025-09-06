<?php

/**
 * ArtLine Hostinger Configuration Tester
 * 
 * This script helps verify that your Laravel application is properly 
 * configured for Hostinger hosting with MySQL database.
 */

echo "<h1>🎨 ArtLine - Hostinger Configuration Test</h1>";

// Check PHP version
echo "<h2>📋 Server Information</h2>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' . "</p>";

// Check required PHP extensions
echo "<h2>🔧 PHP Extensions</h2>";
$required_extensions = ['pdo', 'pdo_mysql', 'openssl', 'mbstring', 'tokenizer', 'xml', 'curl', 'json'];
foreach ($required_extensions as $ext) {
    $status = extension_loaded($ext) ? '✅' : '❌';
    echo "<p>{$status} {$ext}</p>";
}

// Check Laravel directories and permissions
echo "<h2>📁 Directory Permissions</h2>";
$directories = [
    'storage' => 'storage/',
    'bootstrap/cache' => 'bootstrap/cache/',
    'storage/logs' => 'storage/logs/',
    'storage/framework' => 'storage/framework/',
];

foreach ($directories as $name => $path) {
    if (is_dir($path)) {
        $perms = substr(sprintf('%o', fileperms($path)), -4);
        $writable = is_writable($path) ? '✅' : '❌';
        echo "<p>{$writable} {$name} ({$perms})</p>";
    } else {
        echo "<p>❌ {$name} (not found)</p>";
    }
}

// Check .env file
echo "<h2>⚙️ Configuration</h2>";
if (file_exists('.env')) {
    echo "<p>✅ .env file exists</p>";
    
    // Load environment variables
    $env_content = file_get_contents('.env');
    
    // Check database configuration
    if (strpos($env_content, 'DB_CONNECTION=mysql') !== false) {
        echo "<p>✅ Database configured for MySQL</p>";
    } else {
        echo "<p>❌ Database not configured for MySQL</p>";
    }
    
    if (strpos($env_content, 'APP_ENV=production') !== false) {
        echo "<p>✅ App environment set to production</p>";
    } else {
        echo "<p>⚠️ App environment not set to production</p>";
    }
    
    if (strpos($env_content, 'APP_DEBUG=false') !== false) {
        echo "<p>✅ Debug mode disabled</p>";
    } else {
        echo "<p>⚠️ Debug mode not disabled</p>";
    }
} else {
    echo "<p>❌ .env file not found</p>";
}

// Test database connection (if config is available)
echo "<h2>🗄️ Database Connection</h2>";
try {
    if (file_exists('.env')) {
        // Parse .env file manually for testing
        $env_lines = file('.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $env_vars = [];
        foreach ($env_lines as $line) {
            if (strpos($line, '=') !== false && substr($line, 0, 1) !== '#') {
                list($key, $value) = explode('=', $line, 2);
                $env_vars[trim($key)] = trim($value);
            }
        }
        
        if (isset($env_vars['DB_HOST']) && isset($env_vars['DB_DATABASE']) && 
            isset($env_vars['DB_USERNAME']) && isset($env_vars['DB_PASSWORD'])) {
            
            $host = $env_vars['DB_HOST'];
            $db = $env_vars['DB_DATABASE'];
            $user = $env_vars['DB_USERNAME'];
            $pass = $env_vars['DB_PASSWORD'];
            
            if ($host !== 'your_database_host' && $db !== 'your_database_name') {
                $dsn = "mysql:host={$host};dbname={$db}";
                $pdo = new PDO($dsn, $user, $pass);
                echo "<p>✅ Database connection successful</p>";
                echo "<p><strong>Connected to:</strong> {$db}</p>";
            } else {
                echo "<p>⚠️ Database credentials not configured yet</p>";
            }
        } else {
            echo "<p>❌ Database configuration incomplete</p>";
        }
    }
} catch (PDOException $e) {
    echo "<p>❌ Database connection failed: " . $e->getMessage() . "</p>";
}

// Check Laravel installation
echo "<h2>🚀 Laravel Status</h2>";
if (file_exists('artisan')) {
    echo "<p>✅ Laravel installation detected</p>";
    
    if (file_exists('vendor/autoload.php')) {
        echo "<p>✅ Composer dependencies installed</p>";
    } else {
        echo "<p>❌ Composer dependencies not installed</p>";
    }
    
    if (file_exists('public/index.php')) {
        echo "<p>✅ Public directory exists</p>";
    } else {
        echo "<p>❌ Public directory not found</p>";
    }
} else {
    echo "<p>❌ Laravel not properly installed</p>";
}

echo "<hr>";
echo "<h2>📝 Next Steps for Hostinger Deployment:</h2>";
echo "<ol>";
echo "<li>Update your .env file with actual Hostinger database credentials</li>";
echo "<li>Upload all files to your Hostinger hosting directory</li>";
echo "<li>Set proper file permissions (755 for directories, 644 for files)</li>";
echo "<li>Run 'php artisan migrate' to create database tables</li>";
echo "<li>Configure your domain to point to the public folder</li>";
echo "<li>Enable HTTPS in your Hostinger control panel</li>";
echo "</ol>";

echo "<p><strong>For support, check the deploy.md file in your project root.</strong></p>";
?>
