#!/bin/bash
# Script to quickly create sub-theme.

echo '
+------------------------------------------------------------------------+
| With this script you could quickly create CU Base sub-theme            |
| In order to use this:                                                  |
| - cu_theme_base theme (this folder) should be in the custom folder           |
+------------------------------------------------------------------------+
'
echo 'The machine name of your custom theme? [e.g. cu_system]'
read CUSTOM_CU

echo 'Your theme name ? [e.g. My custom cu]'
read CUSTOM_CU_NAME

if [[ ! -e ../../custom ]]; then
    mkdir ../../custom
fi
cp -r subtheme ../../custom/$CUSTOM_CU
cd ../../custom/$CUSTOM_CU
for file in *cu_theme_base_subtheme.*; do mv $file ${file//cu_theme_base_subtheme/$CUSTOM_CU}; done
for file in config/*/*cu_theme_base_subtheme.*; do mv $file ${file//cu_theme_base_subtheme/$CUSTOM_CU}; done
mv {_,}$CUSTOM_CU.theme
grep -Rl cu_theme_base_subtheme .|xargs sed -i '' -e "s/cu_theme_base_subtheme/$CUSTOM_CU/"
sed -i -e "s/CU Base Subtheme/$CUSTOM_CU_NAME/" $CUSTOM_CU.info.yml.EXAMPLE
echo "# Check the themes/custom folder for your new sub-theme."
