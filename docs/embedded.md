[<< Volver al inicio](../../../)

## Archivo de configuración embedded.conf

_En este archivo se administran algunas de la configuraciones de la capa multicanal Bancaplus-V3, el archivo se encuentra en la siguiente ruta:_

>bancaplus-v3/bancaplus-dummy-integration/src/main/resources/embedded.conf

### Configuraciones disponibles:

- _Archivos para configurar los distintos lenguajes manejados por Bancaplus_

```csharp
    messages {
        include "messages.en.conf"
        include "messages.es.conf"
    }
```

- _Configuración para definir el orden de las vistas que se utilizará para el registro de usuarios según el tipo de usuario. Las opciones disponibles son:_

    1. antiPhisingImage
    1. password
    1. privilegedImage
    1. privilegedPassword
    1. secondAuthCodeCard
    1. secondAuthToken
    1. securityQuestions
    1. termsAndConditions
    1. userInformation
    1. frequentDevice

```csharp
signupRegex = {
    password = {
      fullRegex = ".*"
      tokenizedRegex = [
        {regex: "(?=.{8,})", description: "Length"},
        {regex: "(?=.*[a-zA-Z])", description: "Letters"},
        {regex: "(?=.*\\d)", description: "Numeric"},
        {regex: "(?=.*[!#$%&? \"])", description: "Special Char"}]
    }

    privilegedPassword = {
      fullRegex = ""
      tokenizedRegex = [
        {regex: "(?=.{8,})", description: "Length"},
        {regex: "(?=.*[a-zA-Z])", description: "Letters"},
        {regex: "(?=.*\\d)", description: "Numeric"},
        {regex: "(?=.*[!#$%&? \"])", description: "Special Char"}]
    }

    usernameRegex = {
      fullRegex = ".*"
      tokenizedRegex = [
        {regex: "(?=.{8,})", description: "Length"},
        {regex: "(?=.*[a-zA-Z])", description: "Letters"},
        {regex: "(?=.*\\d)", description: "Numeric"},
        {regex: "(?=.*[!#$%&? \"])", description: "Special Char"}]
    }
  }
```

- _Configuración de los Regex para el registro de nuevos usuarios._

```csharp
signupRegex = {
    password = {
      fullRegex = ".*"
      tokenizedRegex = [
        {regex: "(?=.{8,})", description: "Length"},
        {regex: "(?=.*[a-zA-Z])", description: "Letters"},
        {regex: "(?=.*\\d)", description: "Numeric"},
        {regex: "(?=.*[!#$%&? \"])", description: "Special Char"}]
    }

    privilegedPassword = {
      fullRegex = ""
      tokenizedRegex = [
        {regex: "(?=.{8,})", description: "Length"},
        {regex: "(?=.*[a-zA-Z])", description: "Letters"},
        {regex: "(?=.*\\d)", description: "Numeric"},
        {regex: "(?=.*[!#$%&? \"])", description: "Special Char"}]
    }

    usernameRegex = {
      fullRegex = ".*"
      tokenizedRegex = [
        {regex: "(?=.{8,})", description: "Length"},
        {regex: "(?=.*[a-zA-Z])", description: "Letters"},
        {regex: "(?=.*\\d)", description: "Numeric"},
        {regex: "(?=.*[!#$%&? \"])", description: "Special Char"}]
    }
  }
```

- _Configuración de los tipos de afiliaciones Disponibles_

```csharp
affiliationCategories = [
    {categoryId = "P2PAffiliationBank", displayNameId = "affiliations.P2PAffiliationBank"}
    {categoryId = "statement", displayNameId = "affiliations.statement"}
  ]
```

- _Configuración para los tipos de beneficiarios_

```csharp
beneficiaryCategories = [
    {categoryId = "sameBank", displayNameId = "beneficiaries.sameBank", validateFor = 195, twoPhases = false},
    {categoryId = "otherBank", displayNameId = "beneficiaries.otherBank", validateFor = 195, twoPhases = false},
    {categoryId = "wireTransfer", displayNameId = "beneficiaries.wireTransfer", validateFor = 195, twoPhases = false}
    {categoryId = "otherCreditCards", displayNameId = "beneficiaries.otherCreditCards", validateFor = 195, twoPhases = false}
    {categoryId = "otherBankCreditCards", displayNameId = "beneficiaries.otherBankCreditCards", validateFor = 195, twoPhases = false}
    {categoryId = "servicesCantv", displayNameId = "beneficiaries.servicesCantv", validateFor = 225, extraCategory = "services", extraCategoryDisplayName ="beneficiaries.services", twoPhases = false}
    {categoryId = "servicesMovilnet", displayNameId = "beneficiaries.servicesMovilnet", validateFor = 225, extraCategory = "services", extraCategoryDisplayName ="beneficiaries.services", twoPhases = false}
    {categoryId = "servicesMovistar", displayNameId = "beneficiaries.servicesMovistar", validateFor = 225, extraCategory = "services", extraCategoryDisplayName ="beneficiaries.services", twoPhases = false}
    {categoryId = "servicesEleval", displayNameId = "beneficiaries.servicesEleval", validateFor = 225, extraCategory = "services", extraCategoryDisplayName ="beneficiaries.services", twoPhases = false}
    {categoryId = "servicesCollectionsTaxes", displayNameId = "beneficiaries.collectionsTaxes", validateFor = 97, extraCategory = "services", extraCategoryDisplayName ="beneficiaries.services", twoPhases = true}
    {categoryId = "P2PSameBank", displayNameId = "beneficiaries.P2PSameBank", validateFor = 197, twoPhases = false},
    {categoryId = "P2POtherBank", displayNameId = "beneficiaries.P2POtherBank", validateFor = 197, twoPhases = false},
    {categoryId = "payroll", displayNameId = "beneficiaries.payroll", validateFor = 8, twoPhases = false}
    {categoryId = "suppliers", displayNameId = "beneficiaries.suppliers", validateFor = 16, twoPhases = false}
  ]
```

 ***validateFor*** _= Valor en suma de bit que define en que modulo sera mostrada la categoría. La clasificación que se mostrara cuando un bit esta encendido se muestra a continuación:_

1. _RegisteredTransfer = 1_
1. _AnonymousTransfer = 2_
1. _P2P = 4_
1. _Payroll = 8_
1. _PaymentSuppliers = 16_
1. _PaymentService = 32_
1. _ProgrammedTransfer = 64_
1. _BeneficiaryCrud = 128_

***twoPhases*** _= Define si la información de la categoría para la creación de un beneficiario es tomada un una o dos fases._

- _Configuración que define la categoria de los mensajes para los servicios GET y POST de la ruta:_ 
  > /user/messages

```csharp
messageSubjects = [
    {categoryId = "complain", displayNameId = "subject.complain"},
    {categoryId = "newRequirement", displayNameId = "subject.newRequirement"},
    {categoryId = "additionalRequests", displayNameId = "subject.additionalRequests"},
    {categoryId = "refunds", displayNameId = "subject.refunds"}
]
```

- _Definición de categorías para los instrumentos_

```csharp
instrumentCategories = [
    {categoryId = "checkingAccounts", displayNameId = "instruments.checkingAccounts", extraCategory ="accounts", extraCategoryDisplayName = "instruments.accounts" },
    {categoryId = "savingAccounts", displayNameId = "instruments.savingAccounts" , extraCategory ="accounts", extraCategoryDisplayName = "instruments.accounts"},
    {categoryId = "creditCards", displayNameId = "instruments.creditCards"},
    {categoryId = "investments", displayNameId = "instruments.investments"},
    {categoryId = "loans", displayNameId = "instruments.loans"},
    {categoryId = "claims", displayNameId = "instruments.claims"}
]
```

- _Definición de categorías para las solicitudes_

```csharp
requestCategories = [
    {
      categoryId = "user", displayNameId = "requests.userRequest", show = true, subCategories = [{subCategoryId = "reference", displayNameId = "requests.user.reference", requestSteps = ["step1"]},
      {subCategoryId = "check", displayNameId = "requests.user.check", requestSteps = ["step1"]},
      {subCategoryId = "checkFail", displayNameId = "requests.user.checkFail", requestSteps = ["step1"]},
      {subCategoryId = "openAccount", displayNameId = "requests.user.openAccount", requestSteps = ["step1", "step2"]},
      {subCategoryId = "cashiersCheck", displayNameId = "requests.user.cashiersCheck", requestSteps = ["step1"]},
      {subCategoryId = "complaint", displayNameId = "requests.user.complaint", requestSteps = ["step1"]},
      {subCategoryId = "termDeposit", displayNameId = "requests.user.termDeposit", requestSteps = ["step1", "step2"]}]
    },
    {
      categoryId = "credits", displayNameId = "requests.creditsRequest", show = true, subCategories = [{subCategoryId = "extraFinancing", displayNameId = "requests.credits.extraFinancing", requestSteps = ["step1", "step2"]}
      {subCategoryId = "effectiveAdvance", displayNameId = "requests.credits.effectiveAdvance", requestSteps = ["step1"]},
      {subCategoryId = "businessCredit", displayNameId = "requests.credits.businessCredit", requestSteps = ["step1"]},
      {subCategoryId = "creditSimulator", displayNameId = "requests.credits.creditSimulator", requestSteps = [], state = "creditSimulator"}]
    },
    {
      categoryId = "account", displayNameId = "requests.accountRequest", show = false, subCategories = [{subCategoryId = "statement", displayNameId = "requests.account.statement", requestSteps = ["step1"]}]
    }
  ]
```

- _Orden de las propiedades para cada instrumento_

```csharp
instrumentPropertyOrder = [
    {categoryId = "checkingAccounts", order = ["balance", "available", "ep01"]},
    {categoryId = "savingAccounts", order = ["balance", "available"]},
    {categoryId = "creditCards", order = ["balance", "available"]},
    {categoryId = "loans", order = ["balance", "available"]},
    {categoryId = "investments", order = ["available", "ep01", "ep02"]},
    {categoryId = "claims", order = ["balance", "available"]},
]
```

- _Categorías para recuperar información del usuario_

```csharp
forgotUserCategories = [
    {categoryId = "user", displayNameId = "forgot.user"},
    {categoryId = "password", displayNameId = "forgot.password"}
]
```

- _Moneda predeterminada_

```csharp  
defaultCurrency = "USD"
```

- _Definición de schemas utilizados en Bancaplus-V3_

```csharp
schemas = {
    include "schemas.signup.conf"
    include "schemas.forgotUser.conf"
    include "schemas.affiliation.conf"
    include "schemas.beneficiary.conf"
    include "schemas.request.conf"
    include "schemas.transfer.conf"
    include "schemas.programmedTransfer.conf"
    include "schemas.time.conf"
    include "schemas.adminUser.conf"
    include "schemas.advancedFactor.conf"
  }
```

- _Tiempo de espera de integración_

```csharp
  integrationTimeout = 15 seconds
```

- _Aprobación única o múltiple al invocar el punto final_

```csharp
typeModel
  {
    executeApproval = "single"
  }
```

- _Activación de módulos por perfiles_

```csharp
  bancaplusFunctionalities {
    web {
      functionalityList = [
        {
          canal = "web", roleName = "Admin", functionalities = ["MOD_TRANSFERS","MOD_TPROGRAMS","MOD_TRANSFERS", "MOD_STATEMENT", "MOD_MAILBOX"]
        },
        {
          canal = "web", roleName = "User", functionalities = ["MOD_TRANSFERS","MOD_TPROGRAMS", "MOD_STATEMENT", "MOD_USERCREATION", "MOD_MAILBOX"]
        },
      ]
    }
    mobile {
      functionalityList = [
        {
          canal = "mobile", roleName = None, permissionName = "Personal", functionalities = ["MOD_TRANSFERS","MOD_TPROGRAMS", "MOD_STATEMENT", "MOD_MAILBOX", "MOD_BENEFICIARIES", "MOD_SERVICES", "MOD_REQUESTS", "MOD_PRODUCTS", "MOD_CREDITS", "MOD_P2P", "MOD_TSIMPLE", "MOD_TMULTIPLE","MOD_CHANGE_PASSWORD","MOD_CHANGE_PRIVILEGED_PASSWORD","MOD_BIOAUTH","MOD_QR"]
        },
        {
          canal = "mobile",  roleName = None, permissionName = "Operator", functionalities = ["MOD_TRANSFERS", "MOD_STATEMENT", "MOD_BENEFICIARIES", "MOD_SUPPLIERS", "MOD_PAYROLLS", "MOD_MAILBOX", "MOD_SERVICES"]
        },
        {
          canal = "mobile",  roleName = None, permissionName = "Approver", functionalities = ["MOD_STATEMENT", "MOD_REQUESTS", "MOD_APPROVALS", "MOD_MAILBOX"]
        },
        {
          canal = "mobile",  roleName = None, permissionName = "Master", functionalities = ["MOD_STATEMENT", "MOD_BENEFICIARIES", "MOD_REQUESTS", "MOD_PRODUCTS", "MOD_USERCREATION", "MOD_MAILBOX", "MOD_SERVICES"]
        },
        {
          canal = "mobile",  roleName = None, permissionName = "All", functionalities = ["MOD_TRANSFERS", "MOD_STATEMENT", "MOD_USERCREATION", "MOD_BENEFICIARIES", "MOD_SUPPLIERS", "MOD_PAYROLLS", "MOD_REQUESTS", "MOD_APPROVALS", "MOD_PRODUCTS", "MOD_MAILBOX", "MOD_SERVICES", "MOD_P2P", "MOD_CREDITS"]
        }
      ]
    }
  }
```

- _Configuración de enlaces para tutoriales_

```csharp
  tutorialList = [
    {id = "tutorial1" , displayName = "tutorial.synergy", url = "http://www.synergy-gb.com/newsgb/index.php"},
    {id = "tutorial2" , displayName = "tutorial.youtube", url = "https://www.youtube.com/user/SynergyGB"},
    {id = "tutorial3" , displayName = "tutorial.linkedin", url = "https://www.linkedin.com/company/synergy-gb/"}
  ]
}
```

- _Configuración de claves proporcionadas por Google para el uso de ReCaptcha_

```csharp
googleReCaptcha = {
  enableVerifyGoogleReCaptcha = false
  secretKeyReCaptcha = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe"
  siteVerifyGoogleReCaptcha = "https://www.google.com/recaptcha/api/siteverify"
}
```

- _Configuración de Roles_

```csharp
include "adminUserRolesAndPermission.conf"
```

- _Configuración de cod. 403 para los servicios_

```csharp
include "extraAuth.conf"
```

- _Indique aquí los límites para los tipos de transferencia. Los límites deben determinarse por categoría de canal y de transferencia - aprobación única o múltiple en la invocación del punto final.
Puede validar varios valores en el esquema colocando varias posiciones de validación en el conjunto de validaciones._

```csharp
transferLimits {
  mobile.sameBank = [
    {
      amountId = "amount"
      amount = 10000.00
    }]
}
```
- _Configuración de duración de la sesión. El valor predeterminado es 30 minutos.
Los valores pueden ser:_

  1. _En minutos (3 minutes)_
  1. _En días (2 days)_

```csharp
auth {
  sessionDuration = 3 minutes

}
```

- _Configuración de módulos auxiliares de Bancaplus_

```csharp
include "ModuleSGB.conf"
```

[<< Volver al inicio](../../../)