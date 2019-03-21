# Creating an Extension

Each extension has four crucial parts:

1. Annotation(s)
2. Metadata Driver Extension
3. Event Listener
4. Tests

For a minimal example of a complete extension, check out [Sluggable](../src/Extension/Sluggable).

## Annotations

Annotations are used to define the custom metadata used by an extension.
An extension may use annotations at the class and/or property level.

Read more about [creating your own annotation classes](https://www.doctrine-project.org/projects/doctrine-annotations/en/1.6/custom.html#custom-annotation-classes).

## Metadata Driver Extension

Each extension understands how to parse its own annotations during the metadata
loading process. The driver extension should implement
[`AnnotationDriverExtensionInterface`](../src/Common/Metadata/Driver/AnnotationDriverExtensionInterface.php).

## Event Listener

An event listener is technically optional. However, because our extensions take action
on your behalf without additional work, its likely all extensions will include at least
one listener.

An extension's event listener can implement any and all
[lifecycle events](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/events.html#reference-events-lifecycle-events)
needed to provide the desired functionality. For example, an extension only designed to
add or change data on initial save only needs to listen for the `prePersist` event.

## Tests

At the core of every stable product is a well-covered test suite. Fully testing your
extension is critical to the success of our package and its users.

On top of unit testing specific classes and components, we offer a
[base functional test case](../src/Common/Test/AbstractFunctionalTestCase.php) to ensure
your extension's lifecycle completes as-expected.

## Service & Other Classes

An extension is welcomed to add in any necessary service classes, adapters, third-party
packages, or whatever it needs in order to complete its objectives.

# Ready To Contribute?

Open an issue or a pull request today with details about the extension you'd like to
contribute! We can't wait to hear from you. :smile:
