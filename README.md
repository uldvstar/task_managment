This project was created in 1 week with a code generator I have created to increase productivity, and this is the **"real-world usage test"** to learn more about the limitations  and downfalls of the generator.


## Files Structure

####Common Backend file structure

Inside App/Modules:

- Each module on the site is separated into folders without sub-categorization 
- Controller logic is all the logic required before executing the action
- Data Transfer Objects are class in charge of validating the request data types & for unifying the methods and the names for request data
- Service classes are for executing specific actions and don't run any conditions
- Standards are represent the rule for executing an action like authorization, validations, and criterias

####Common Vue Files

#####General Components 
- list component is responsible for calling the fetch endpoint and uses 3 components:
    1. Loading animation component
    2. slot for custom component (e.g. user component, client component)
    3. pagination component
- Validation Wrapper component is responsible for each form input validation and displaying validation errors
- Additional support components: 
    1. transition component
    2. Modal Component
    3. Selectable component for fetching data and creating a select input component
    
#####Modules components
- Each module usually has only 3 components:
    1. element component singular component layout 
    2. form component for creating and editing modules
    3. filter component is used for searching a list of components
    
    
## Common Issues

- Some database types are not being converted correctly in the code base and has to be manually fixed after being generated (e.g. UnsignedBigInteger)
- Categorizing the folders is currently 1 level and doesn't really work with sub-categorizations
- There are unnecessary files being generated
- Time tracker backend code needs to be cleaned up 
- Project task generator uses a primitive foreach loop which isn't efficient solution and can be improved
- excessive use of resource objects to loading relationships
- task details vue component needs to be cleaned and divided into smaller components