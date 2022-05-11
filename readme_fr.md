# Pr�-Requis

Il vous faut une alarme Diagral connect�e et utilisable avec l'application e-ONE.

# Installation

Installer le plugin depuis le store Eedomus.

## Configuration

Lors de l'installation, un nouvel appareil `Diagral Alarme` est cr��, et on vous demande de remplir plusieurs param�tres :

![Champs de configuration](https://user-images.githubusercontent.com/946315/167384621-0ce5b79f-14e8-49ab-a23f-cd7306e97781.png)

`username` et `password` sont ceux utilis�s pour vous connecter � l'application e-ONE.

`mastercode` est votre code de s�curit� � 4 chiffres que vous utilisez pour g�rer la centrale.

`systemname` est le nom du syst�me tel que d�fini dans l'application e-ONE quand vous allez dans `Param�trage`, puis dans `G�rer mon profil et mes acc�s`, puis `Changer le nom du syst�me`.

# Utilisation

Une fois l'appareil cr��, vous pouvez aller voir dans l'onglet **Valeurs** :

![Liste des valeurs](https://user-images.githubusercontent.com/946315/167385123-4f28f4cd-3d0d-46fd-a8e7-79f2761c4ffa.png)

Deux valeurs sont possibles : `0` pour `Off` (�teindre l'alarme), et `100` pour `On` (allumer l'alarme). Cela correspond � l'action/d�sactivation totale de l'alarme.

L'�dition de la celulle "Param�tres" va donner quelque chose comme �a :
> _&username=abcdef@something.com&password=votremotdepasse&mastercode=1234&systemname=Maison&action=[RAW_VALUE]_

## Utilisation avec Google et Alexa

Pour activer/d�sactive l'alarme � la voix, vous pouvez aller dans `Configurer` de votre box eedomus, puis dans la section de votre assistant vocal, activez les deux cases pour l'appareil : 

![�teint et allume sont coch�s sous l'appareil Alarme](https://user-images.githubusercontent.com/946315/167385335-cff26b42-5366-46e6-b0bd-6a21ac7d49c6.png)

Donnez le m�me nom aux deux. Ici j'ai mis "Alarme".

J'ai seulement test� avec Alexa, et cette op�ration m'a permis d'avoir un objet "Alarme" que je peux d�clencher � la voix avec _� allume l'alarme �_.
