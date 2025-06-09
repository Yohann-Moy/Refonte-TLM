const fs = require('fs');
const path = require('path');
const UglifyJS = require('uglify-js');

// Répertoire où se trouvent les fichiers communs
const commonDir = 'assets/js/generic';

// Répertoire racine contenant les sous-répertoires spécifiques
const rootDir = 'assets/js/modules/';

// Répertoire de sortie des fichiers minifiés
const outputDir = 'assets/js/';

// Sous-répertoire pour les fichiers minifiés des pages
const pagesOutputDir = path.join(outputDir, 'pages');

// Fichier de sortie global non minifié
const globalOutputFile = path.join(outputDir, 'main.js');

// Fonction pour lister tous les fichiers .js dans un répertoire
function getJavaScriptFiles(directory) {
  return fs.readdirSync(directory).filter(file => file.endsWith('.js')).map(file => path.join(directory, file));
}

// Fonction pour minifier et combiner les fichiers spécifiques d'un répertoire avec les fichiers communs
function minifyDirectory(directory) {
  let combinedCode = '';

  // Minifier les fichiers communs
  const commonFiles = getJavaScriptFiles(commonDir);
  commonFiles.forEach(commonFile => {
    const fileContent = fs.readFileSync(commonFile, 'utf8');
    const minified = UglifyJS.minify(fileContent);
    
    if (minified.error) {
      console.error(`Erreur lors de la minification de ${commonFile}:`, minified.error);
      return;
    }

    combinedCode += minified.code + '\n';
  });

  // Minifier les fichiers spécifiques du répertoire
  const jsFiles = getJavaScriptFiles(directory);
  jsFiles.forEach(jsFile => {
    const fileContent = fs.readFileSync(jsFile, 'utf8');
    const minified = UglifyJS.minify(fileContent);
    
    if (minified.error) {
      console.error(`Erreur lors de la minification de ${jsFile}:`, minified.error);
      return;
    }

    combinedCode += minified.code + '\n';
  });

  // Nommer le fichier de sortie en fonction du répertoire source
  const directoryName = path.basename(directory);
  const outputFilePath = path.join(pagesOutputDir, `${directoryName}.min.js`);

  // Créer le sous-répertoire de sortie s'il n'existe pas
  if (!fs.existsSync(pagesOutputDir)) {
    fs.mkdirSync(pagesOutputDir, { recursive: true });
  }

  // Écriture du fichier combiné minifié pour chaque répertoire
  fs.writeFileSync(outputFilePath, combinedCode, 'utf8');
  console.log(`Minification terminée pour ${directory}, fichier de sortie : ${outputFilePath}`);

  return combinedCode; // Retourner le code combiné pour le fichier global
}

// Fonction pour minifier tous les fichiers communs
function minifyCommonFiles() {
  let combinedCode = '';

  const commonFiles = getJavaScriptFiles(commonDir);
  commonFiles.forEach(commonFile => {
    const fileContent = fs.readFileSync(commonFile, 'utf8');
    const minified = UglifyJS.minify(fileContent);
    
    if (minified.error) {
      console.error(`Erreur lors de la minification de ${commonFile}:`, minified.error);
      return;
    }

    combinedCode += minified.code + '\n';
  });

  return combinedCode;
}

// Fonction pour combiner tous les fichiers JS non minifiés pour le fichier global
function combineAllJavaScriptFiles() {
  let combinedCode = '';

  // Inclure les fichiers communs non minifiés
  const commonFiles = getJavaScriptFiles(commonDir);
  commonFiles.forEach(commonFile => {
    const fileContent = fs.readFileSync(commonFile, 'utf8');
    combinedCode += fileContent + '\n';
  });

  // Inclure les fichiers spécifiques de chaque répertoire
  const directories = getDirectories(rootDir);
  directories.forEach(directory => {
    const jsFiles = getJavaScriptFiles(directory);
    jsFiles.forEach(jsFile => {
      const fileContent = fs.readFileSync(jsFile, 'utf8');
      combinedCode += fileContent + '\n';
    });
  });

  return combinedCode;
}

// Fonction pour obtenir tous les sous-répertoires dans un répertoire donné
function getDirectories(source) {
  return fs.readdirSync(source, { withFileTypes: true })
    .filter(dirent => dirent.isDirectory())
    .map(dirent => path.join(source, dirent.name));
}

// Minification des fichiers communs (à ajouter au début du fichier global)
const commonMinifiedCode = minifyCommonFiles();

// Minification de chaque répertoire spécifique
const directories = getDirectories(rootDir);
directories.forEach(directory => {
  minifyDirectory(directory); // Minifie et écrit chaque répertoire
});

// Création du fichier global non minifié
if (!fs.existsSync(outputDir)) {
  fs.mkdirSync(outputDir, { recursive: true });
}

const globalCombinedCode = combineAllJavaScriptFiles();
fs.writeFileSync(globalOutputFile, globalCombinedCode, 'utf8');
console.log(`Compilation globale terminée : fichier de sortie : ${globalOutputFile}`);
