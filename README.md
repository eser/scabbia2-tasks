# Scabbia2 Tasks Component

[This component](https://github.com/eserozvataf/scabbia2-tasks) provides an command line tool named `scabbia` and `Scabbia\Tasks\TaskBase` base class to help users create specific tasks with them. These tasks can be started in source code or command line.

[![Build Status](https://travis-ci.org/eserozvataf/scabbia2-tasks.png?branch=master)](https://travis-ci.org/eserozvataf/scabbia2-tasks)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/eserozvataf/scabbia2-tasks/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/eserozvataf/scabbia2-tasks/?branch=master)
[![Total Downloads](https://poser.pugx.org/eserozvataf/scabbia2-tasks/downloads.png)](https://packagist.org/packages/eserozvataf/scabbia2-tasks)
[![Latest Stable Version](https://poser.pugx.org/eserozvataf/scabbia2-tasks/v/stable)](https://packagist.org/packages/eserozvataf/scabbia2-tasks)
[![Latest Unstable Version](https://poser.pugx.org/eserozvataf/scabbia2-tasks/v/unstable)](https://packagist.org/packages/eserozvataf/scabbia2-tasks)
[![Documentation Status](https://readthedocs.org/projects/scabbia2-documentation/badge/?version=latest)](https://readthedocs.org/projects/scabbia2-documentation)

## Usage

### Custom Task

```php
namespace MyProject;

use Scabbia\Tasks\TaskBase;
use Scabbia\Formatters\FormatterInterface;

class MyTaskTask extends TaskBase {
    public function executeTask(array $parameters, FormatterInterface $formatter) {
        $formatter->write('task is executed, with parameters:');
        $formatter->writeArray($parameters);
    }

    public function help(FormatterInterface $formatter) {
        $formatter->write('help');
    }
}
```

`scabbia myProject:myTask` command will execute your task. Also `scabbia help myProject:myTask` displays the help you've provided.

You can also create your custom command line app, just refer to `vendor/bin/scabbia`.

### Running Tasks at Runtime

```php
use Scabbia\Tasks\Tasks;

Tasks::run('myProject:myTask', ['parameter1', 'parameter2']);
```

### Registering namespaces for commands

```php
use Scabbia\Tasks\Tasks;

Tasks::$namespaces[] = 'MyProject';
```

Therefore `scabbia myTask` will be sufficent to execute your task.

## Links
- [List of All Scabbia2 Components](https://github.com/eserozvataf/scabbia2)
- [Documentation](https://readthedocs.org/projects/scabbia2-documentation)
- [Twitter](https://twitter.com/eserozvataf)
- [Contributor List](contributors.md)
- [License Information](LICENSE)


## Contributing
It is publicly open for any contribution. Bugfixes, new features and extra modules are welcome. All contributions should be filed on the [eserozvataf/scabbia2-tasks](https://github.com/eserozvataf/scabbia2-tasks) repository.

* To contribute to code: Fork the repo, push your changes to your fork, and submit a pull request.
* To report a bug: If something does not work, please report it using GitHub issues.
* To support: [![Donate](https://img.shields.io/gratipay/eserozvataf.svg)](https://gratipay.com/eserozvataf/)
