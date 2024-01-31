from xml.etree.ElementTree import VERSION
from setuptools import setup, find_packages

VERSION = '1.0.0'
DESCRIPTION = 'DAP Token Generation - Python'
LONG_DESCRIPTION = 'This SDK will help you generate the access token using PHP . Using this access token you will be able to connect to widgets supported by UPS.'

#Setup
setup(
    #Name must match fold name
    name = "TokenGenerationLibrary",
    version = VERSION,
    author = "UPS Widget SDK Developer",
    author_email = "upsdapwidgets@ups.com",
    description = DESCRIPTION,
    long_description = LONG_DESCRIPTION,
    packages = find_packages(),
    install_requires = ['requests'],
    keywords = ['python', 'ups', 'dap', 'sdk', 'access token', 'api']
    )
