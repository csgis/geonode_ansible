
# CSGIS GeoNode installation with Ansible
---
This Ansible playbook aims to install GeoNode by use of geonode-project to an Ubuntu Server. 
It tries to stay close to the installation instructions docs: http://docs.geonode.org/en/master/tutorials/install_and_admin/geonode_install/index.html
The tasks are currently quite low level using only one role. For a more versatile playbook visit: 
https://github.com/GeoNode/ansible-geonode

### Prerequisites
```
- Install Ansible https://www.ansible.com/
- Install Python on your target instance:  $ sudo apt install python-minimal
```

### File / Directory overview

- site.yml: the Top-Level playbook which includes plays from ./task and dictates the order.
- ./templates: J2 templates for Apache, Django, Geoserver, Tomcat. These are filled with vars from ./group_vars/all and copied by template module.
- ./assets: Has currently one file with GeoServer build information. Will be removed after geonode build server is introduced again.
- ./tasks: the different plays. Have a look at the GeoNode install docs. You will find similar separations
- ./handlers: service file for tasks


### Installing

Clone this repository

```
git clone https://github.com/csgis/geonode_ansible.git
```

Add the user used for installation to your `/etc/ansible/hosts` file

```
[geonode]
geonode     ansible_ssh_port=2222     ansible_ssh_host=127.0.0.1 ansible_connection=ssh  ansible_ssh_user=geonode ansible_ssh_private_key_file=∞/.ssh/private_key
```

Edit the variables depending on your needs
```
vim ./group_vars/all/vars_file.yml
```
Get familiar with the tasks in:
```
$ ls ./tasks
```
Get familiar with the main playbook and the order tasks are run
```
$ cat ./site.yml
```
Run the main playbook which (includes other tasks) and keep fingers crossed
```
ansible-playbook -v site.yml
```

## Roadmap
- Tidy up, a lot of stuff can be done by use of ansible modules instead of `shell` or `command`
- add branch for 2.8 and Bionic
- add https support


## Contributing
... is very welcome

## License
This project is licensed under the MIT License.
