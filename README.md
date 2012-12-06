[magixcms](http://www.magix-cms.com/)
===================================================

Presentation
------------

Magix cms est un gestionnaire de contenu développé en PHP 5,
proposant une multitude d'outils intégrés.
Le gestionnaire est simple et intuitif permettant une adaptation rapide pour tout utilisateur,
ainsi qu'une indexation optimal dans les moteurs de recherches.

## Note
    N'utilisez pas la version de ce dépôt pour autre chose que vos propres tests,
    la dernière version stable sur le site est optimisé pour la mise en production.

Authors
-------

 * Gerits Aurelien (Author-Developer) contact[at]aurelien-gerits[point]be - aurelien[at]magix-cms[point]com
    * [magixcms](http://www.magix-cms.com)
    * [CV Aurelien Gerits](http://www.aurelien-gerits.be)
    * [Github Aurelien Gerits](https://github.com/gtraxx/)
    * [MagixcjQuery](http://www.magix-cjquery.com)

## Contributors

 * Lesire Samuel (www.sire-sam.be)
 
Site officiel
-----

 * http://www.magix-cms.com (site officiel)
 * http://www.magix-cms.net (documentation développeur)

Requirements
------------

### Server
 * APACHE / IIS / NGINX
     * Le serveur doit avoir la réécriture d'url activé pour fonctionné (rewrite_mod).
 * PHP 5.2 et plus
     * GD activé
     * SPL
     * SimpleXML et XML READER
     * PDO
 * MYSQL

### Required Library

    Smarty 3 (http://www.smarty.net/download)
    copy to: /lib/smarty3

    Magixcjquery (http://sourceforge.net/projects/magixcjquery/files/magixcjquery-stable/3.x/)
    copy to: /lib/magixcjquery

Il faut ajouté le dossier smarty3 et magixcjquery dans le dossier lib,
vous pouvez télécharger les dernières versions pour être compatible avec magix cms.

Licence
------------

<pre>
This file is part of Magix CMS.
Magix CMS, a CMS optimized for SEO

Copyright (C) 2008 - 2012 magix-cms.com support[at]magix-cms[point]com

OFFICIAL TEAM :

-  Gerits Aurelien (Author - Developer) contact[at]aurelien-gerits[point]be - aurelien[at]magix-cms[point]com

Redistributions of files must retain the above copyright notice.
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

####DISCLAIMER

Do not edit or add to this file if you wish to upgrade magixcms to newer
versions in the future. If you wish to customize magixcms for your
needs please refer to magix-cms.com for more information.
</pre>