#Console Command Chaining

A Symfony bundle that implements command chaining functionality. Other Symfony bundles in the application may register their console commands to be members of a command chain. When a user runs the main command in a chain, all other commands registered in this chain should be executed as well. Commands registered as chain members can no longer be executed on their own

For example, some bundle introduces a console command, called `some:command`.
Another bundle introduces another command `another:command` and registers it as a member of command chain of `some:command`. Now, when a user runs `php bin/console some:command`, both `some:command` and `another:command` should be executed.
Commands registered as chain members can no longer be executed on their own, so `php bin/console another:command` should produce an error.

For the demonstration purposes there are two bundles MasterBundle and SlaveBundle.
MasterBundle should introduce the `master:hello` console command. This command, if there were no other commands registered in its chain, would produce the following output:
```
$ php bin/console master:hello
Hi from Master!
```
SlaveBundle should introduce the `slave:hello` console command and register it as a member of `master:hello`. If this command were not registered as a member of a chain, it would produce the following output:

```
$ php bin/console slave:hello
Hello from Slave!
```
Because `slave:hello` is registered as a member of `master:hello` command chain, the actual output should now become:
```
$ php bin/console master:hello
Hi from Master!
Hello from Slave!
```
```
$ php bin/console slave:hello
Error: slave:hello command is a member of command chain and cannot be executed on its own.
```