## Investigación de AWS CloudFormation

Cloud Formation es es un servicio que ayuda a modelar y configurar 
los recursos de Amazon Web Services. La
[documentación](https://docs.aws.amazon.com/es_es/AWSCloudFormation/latest/UserGuide/Welcome.html) 
es muy completa y extensa, la idea de esta documentación es tomar
algunos atajos a ciertos lugares de la documentación para ser más fácil 
de navegar según lo investigado.

### Cloud Former

Cloud Former es un template de CloudFormation que levanta una máquina 
en AWS y te permite crear un template a partir de las configuraciones 
que ya tengas en la cuenta de AWS, está en versión beta y se usó para 
crear un template en JSON que estará al final del documento, es 
sencillo de usar y se deja el 
[link](https://docs.aws.amazon.com/es_es/AWSCloudFormation/latest/UserGuide/cfn-using-cloudformer.html) 
de un pequeño ejemplo de uso. Sirve para dar una idea de como podría 
ser una guía para empezar la creación del template.

### Uso de la pila

Para la creación y el uso de la pila se deja el link a la 
[documentación](https://docs.aws.amazon.com/es_es/AWSCloudFormation/latest/UserGuide/stacks.html). 
La pila se puede actualizar pero nunca se probó como se hace, por lo 
investigado se tiene que usar otro template y la pila trata de 
actualizarse, en este 
[link](https://docs.aws.amazon.com/es_es/AWSCloudFormation/latest/UserGuide/using-cfn-updating-stacks.html) 
se encuentra la documentación para la actualización de pila.

### Ejemplos de plantillas de AWS

En la 
[documentación](https://docs.aws.amazon.com/es_es/AWSCloudFormation/latest/UserGuide/cfn-sample-templates.html) 
tienen una gran cantidad de ejemplos, buscar el ejemplo de la región 
correspondientes y descargarlos.

### Recursos de AWS

En el siguiente 
[link](https://docs.aws.amazon.com/es_es/AWSCloudFormation/latest/UserGuide/aws-template-resource-type-ref.html) 
hay una lista de los recursos que se pueden usar dentro de la creación 
del template.


### To do

- Investigar el update de las pilas de las versiones de los recursos
que se instala en la maquina como por ejemplo la version de v3.
- La creación del template que conlleva aprender a usar el 
pseudolenguaje que usa CloudFormation, desde la especificaciones del 
mismo CloudFormation como el uso de scripts para instalar herramientas 
que no maneja aws en la máquina como los jar que se deseen instalar ya 
sea v3 o de la instancia.

### Plantilla resultado de usar CloudFormer

Esta plantilla se creó usando CloudFormer sobre algunas de las 
configuraciones existentes en la cuenta de AWS de la empresa.

```json
{
  "AWSTemplateFormatVersion": "2010-09-09",
  "Resources": {
    "vpcc435f6be": {
      "Type": "AWS::EC2::VPC",
      "Properties": {
        "CidrBlock": "10.0.0.0/16",
        "InstanceTenancy": "default",
        "EnableDnsSupport": "true",
        "EnableDnsHostnames": "false",
        "Tags": [
          {
            "Key": "Cliente",
            "Value": "Banco Panama"
          },
          {
            "Key": "Name",
            "Value": "Banco Panama"
          }
        ]
      }
    },
    "subnet04febd4d2eb0bd8c1": {
      "Type": "AWS::EC2::Subnet",
      "Properties": {
        "CidrBlock": "10.0.1.0/24",
        "AvailabilityZone": "us-east-1f",
        "VpcId": {
          "Ref": "vpcc435f6be"
        },
        "Tags": [
          {
            "Key": "Name",
            "Value": "Banco Panama Pr"
          }
        ]
      }
    },
    "subnet9ddaad92": {
      "Type": "AWS::EC2::Subnet",
      "Properties": {
        "CidrBlock": "10.0.0.0/24",
        "AvailabilityZone": "us-east-1f",
        "VpcId": {
          "Ref": "vpcc435f6be"
        },
        "Tags": [
          {
            "Key": "Name",
            "Value": "Banco panamaQA"
          }
        ]
      }
    },
    "igwbe1321c6": {
      "Type": "AWS::EC2::InternetGateway",
      "Properties": {
        "Tags": [
          {
            "Key": "Cliente",
            "Value": "Banco Panama"
          },
          {
            "Key": "Name",
            "Value": "Banco Panama"
          }
        ]
      }
    },
    "cgwc3ba4aaa": {
      "Type": "AWS::EC2::CustomerGateway",
      "Properties": {
        "Tags": [
          {
            "Key": "Cliente",
            "Value": "Banco Panama"
          },
          {
            "Key": "Name",
            "Value": "Banco Panama"
          }
        ],
        "Type": "ipsec.1",
        "IpAddress": "190.242.67.58",
        "BgpAsn": "65000"
      }
    },
    "vgwad03f2c4": {
      "Type": "AWS::EC2::VPNGateway",
      "Properties": {
        "Type": "ipsec.1",
        "Tags": [
          {
            "Key": "Cliente",
            "Value": "Banco Panama"
          },
          {
            "Key": "Name",
            "Value": "Banco Panama"
          }
        ]
      }
    },
    "doptb19f8cd3": {
      "Type": "AWS::EC2::DHCPOptions",
      "Properties": {
        "DomainName": "ec2.internal",
        "DomainNameServers": [
          "AmazonProvidedDNS"
        ]
      }
    },
    "vpncab6a8ab": {
      "Type": "AWS::EC2::VPNConnection",
      "Properties": {
        "Tags": [
          {
            "Key": "Cliente",
            "Value": "Banco Panama"
          },
          {
            "Key": "Name",
            "Value": "Banco Panama"
          }
        ],
        "Type": "ipsec.1",
        "StaticRoutesOnly": "true",
        "VpnGatewayId": {
          "Ref": "vgwad03f2c4"
        },
        "CustomerGatewayId": {
          "Ref": "cgwc3ba4aaa"
        }
      }
    },
    "acl99163de3": {
      "Type": "AWS::EC2::NetworkAcl",
      "Properties": {
        "VpcId": {
          "Ref": "vpcc435f6be"
        },
        "Tags": [
          {
            "Key": "Cliente",
            "Value": "Banco Panama"
          },
          {
            "Key": "Name",
            "Value": "Banco Panama"
          }
        ]
      }
    },
    "rtb8ac7a3f5": {
      "Type": "AWS::EC2::RouteTable",
      "Properties": {
        "VpcId": {
          "Ref": "vpcc435f6be"
        },
        "Tags": [
          {
            "Key": "Cliente",
            "Value": "Banco Panama"
          },
          {
            "Key": "Name",
            "Value": "Banco panamaQA"
          }
        ]
      }
    },
    "rtbd1f89cae": {
      "Type": "AWS::EC2::RouteTable",
      "Properties": {
        "VpcId": {
          "Ref": "vpcc435f6be"
        },
        "Tags": [
          {
            "Key": "Name",
            "Value": "Banco Panama"
          }
        ]
      }
    },
    "eip5220521546": {
      "Type": "AWS::EC2::EIP",
      "DependsOn": [
        "gw1",
        "gw2"
      ],
      "Properties": {
        "Domain": "vpc"
      }
    },
    "instancei0f53f5e060f17a985": {
      "Type": "AWS::EC2::Instance",
      "Properties": {
        "DisableApiTermination": "false",
        "InstanceInitiatedShutdownBehavior": "stop",
        "ImageId": "ami-cfe4b2b0",
        "InstanceType": "t2.micro",
        "KeyName": "BancoPanamaQA",
        "Monitoring": "false",
        "Tags": [
          {
            "Key": "Cliente",
            "Value": "Banco Panama"
          },
          {
            "Key": "environment",
            "Value": "Quality"
          },
          {
            "Key": "Name",
            "Value": "Banco-Panama-Nginx"
          }
        ],
        "NetworkInterfaces": [
          {
            "DeleteOnTermination": "true",
            "Description": "Primary network interface",
            "DeviceIndex": 0,
            "SubnetId": {
              "Ref": "subnet9ddaad92"
            },
            "PrivateIpAddresses": [
              {
                "PrivateIpAddress": "10.0.0.195",
                "Primary": "true"
              }
            ],
            "GroupSet": [
              {
                "Ref": "sgBancopanamahttp"
              },
              {
                "Ref": "sgbancopanamaQA"
              }
            ]
          }
        ]
      }
    },
    "instancei09121f9d7432886e9": {
      "Type": "AWS::EC2::Instance",
      "Properties": {
        "DisableApiTermination": "false",
        "InstanceInitiatedShutdownBehavior": "stop",
        "ImageId": "ami-759bc50a",
        "InstanceType": "t2.micro",
        "KeyName": "BancoPanamaQA",
        "Monitoring": "false",
        "Tags": [
          {
            "Key": "Name",
            "Value": "Banco-Panana-Multicanal2"
          },
          {
            "Key": "environment",
            "Value": "Quality"
          },
          {
            "Key": "Cliente",
            "Value": "Banco Panama"
          }
        ],
        "NetworkInterfaces": [
          {
            "DeleteOnTermination": "true",
            "Description": "Primary network interface",
            "DeviceIndex": 0,
            "SubnetId": {
              "Ref": "subnet9ddaad92"
            },
            "PrivateIpAddresses": [
              {
                "PrivateIpAddress": "10.0.0.117",
                "Primary": "true"
              }
            ],
            "GroupSet": [
              {
                "Ref": "sgBancopanamahttp"
              },
              {
                "Ref": "sgbancopanamaQA"
              }
            ]
          }
        ]
      }
    },
    "sgbancopanamaQA": {
      "Type": "AWS::EC2::SecurityGroup",
      "Properties": {
        "GroupDescription": "launch-wizard-2 created 2018-07-25T15:10:05.547-04:00",
        "VpcId": {
          "Ref": "vpcc435f6be"
        },
        "Tags": [
          {
            "Key": "Name",
            "Value": "Banco Panama"
          },
          {
            "Key": "Cliente",
            "Value": "Banco Panama"
          }
        ]
      }
    },
    "sgBancopanamahttp": {
      "Type": "AWS::EC2::SecurityGroup",
      "Properties": {
        "GroupDescription": "Banco panama",
        "VpcId": {
          "Ref": "vpcc435f6be"
        },
        "Tags": [
          {
            "Key": "Name",
            "Value": "Banco Panama"
          },
          {
            "Key": "Cliente",
            "Value": "Banco Panama"
          }
        ]
      }
    },
    "acl1": {
      "Type": "AWS::EC2::NetworkAclEntry",
      "Properties": {
        "CidrBlock": "0.0.0.0/0",
        "Egress": "true",
        "Protocol": "-1",
        "RuleAction": "allow",
        "RuleNumber": "100",
        "NetworkAclId": {
          "Ref": "acl99163de3"
        }
      }
    },
    "acl2": {
      "Type": "AWS::EC2::NetworkAclEntry",
      "Properties": {
        "CidrBlock": "0.0.0.0/0",
        "Protocol": "-1",
        "RuleAction": "allow",
        "RuleNumber": "100",
        "NetworkAclId": {
          "Ref": "acl99163de3"
        }
      }
    },
    "subnetacl1": {
      "Type": "AWS::EC2::SubnetNetworkAclAssociation",
      "Properties": {
        "NetworkAclId": {
          "Ref": "acl99163de3"
        },
        "SubnetId": {
          "Ref": "subnet9ddaad92"
        }
      }
    },
    "subnetacl2": {
      "Type": "AWS::EC2::SubnetNetworkAclAssociation",
      "Properties": {
        "NetworkAclId": {
          "Ref": "acl99163de3"
        },
        "SubnetId": {
          "Ref": "subnet04febd4d2eb0bd8c1"
        }
      }
    },
    "gw1": {
      "Type": "AWS::EC2::VPCGatewayAttachment",
      "Properties": {
        "VpcId": {
          "Ref": "vpcc435f6be"
        },
        "InternetGatewayId": {
          "Ref": "igwbe1321c6"
        }
      }
    },
    "gw2": {
      "Type": "AWS::EC2::VPCGatewayAttachment",
      "Properties": {
        "VpcId": {
          "Ref": "vpcc435f6be"
        },
        "VpnGatewayId": {
          "Ref": "vgwad03f2c4"
        }
      }
    },
    "subnetroute2": {
      "Type": "AWS::EC2::SubnetRouteTableAssociation",
      "Properties": {
        "RouteTableId": {
          "Ref": "rtbd1f89cae"
        },
        "SubnetId": {
          "Ref": "subnet9ddaad92"
        }
      }
    },
    "subnetroute3": {
      "Type": "AWS::EC2::SubnetRouteTableAssociation",
      "Properties": {
        "RouteTableId": {
          "Ref": "rtbd1f89cae"
        },
        "SubnetId": {
          "Ref": "subnet04febd4d2eb0bd8c1"
        }
      }
    },
    "route1": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "0.0.0.0/0",
        "RouteTableId": {
          "Ref": "rtb8ac7a3f5"
        },
        "GatewayId": {
          "Ref": "igwbe1321c6"
        }
      },
      "DependsOn": "gw1"
    },
    "route2": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "134.177.251.237/32",
        "RouteTableId": {
          "Ref": "rtb8ac7a3f5"
        },
        "GatewayId": {
          "Ref": "vgwad03f2c4"
        }
      },
      "DependsOn": "gw2"
    },
    "route3": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "172.31.31.0/24",
        "RouteTableId": {
          "Ref": "rtb8ac7a3f5"
        },
        "GatewayId": {
          "Ref": "vgwad03f2c4"
        }
      },
      "DependsOn": "gw2"
    },
    "route4": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "192.177.1.0/24",
        "RouteTableId": {
          "Ref": "rtb8ac7a3f5"
        },
        "GatewayId": {
          "Ref": "vgwad03f2c4"
        }
      },
      "DependsOn": "gw2"
    },
    "route5": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "10.1.100.0/24",
        "RouteTableId": {
          "Ref": "rtb8ac7a3f5"
        },
        "GatewayId": {
          "Ref": "vgwad03f2c4"
        }
      },
      "DependsOn": "gw2"
    },
    "route6": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "10.10.114.0/24",
        "RouteTableId": {
          "Ref": "rtb8ac7a3f5"
        },
        "GatewayId": {
          "Ref": "vgwad03f2c4"
        }
      },
      "DependsOn": "gw2"
    },
    "route7": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "10.10.122.0/24",
        "RouteTableId": {
          "Ref": "rtb8ac7a3f5"
        },
        "GatewayId": {
          "Ref": "vgwad03f2c4"
        }
      },
      "DependsOn": "gw2"
    },
    "route8": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "0.0.0.0/0",
        "RouteTableId": {
          "Ref": "rtbd1f89cae"
        },
        "GatewayId": {
          "Ref": "igwbe1321c6"
        }
      },
      "DependsOn": "gw1"
    },
    "route9": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "134.177.251.237/32",
        "RouteTableId": {
          "Ref": "rtbd1f89cae"
        },
        "GatewayId": {
          "Ref": "vgwad03f2c4"
        }
      },
      "DependsOn": "gw2"
    },
    "route10": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "172.31.31.0/24",
        "RouteTableId": {
          "Ref": "rtbd1f89cae"
        },
        "GatewayId": {
          "Ref": "vgwad03f2c4"
        }
      },
      "DependsOn": "gw2"
    },
    "route11": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "192.177.1.0/24",
        "RouteTableId": {
          "Ref": "rtbd1f89cae"
        },
        "GatewayId": {
          "Ref": "vgwad03f2c4"
        }
      },
      "DependsOn": "gw2"
    },
    "route12": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "10.1.100.0/24",
        "RouteTableId": {
          "Ref": "rtbd1f89cae"
        },
        "GatewayId": {
          "Ref": "vgwad03f2c4"
        }
      },
      "DependsOn": "gw2"
    },
    "route13": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "10.10.114.0/24",
        "RouteTableId": {
          "Ref": "rtbd1f89cae"
        },
        "GatewayId": {
          "Ref": "vgwad03f2c4"
        }
      },
      "DependsOn": "gw2"
    },
    "route14": {
      "Type": "AWS::EC2::Route",
      "Properties": {
        "DestinationCidrBlock": "10.10.122.0/24",
        "RouteTableId": {
          "Ref": "rtbd1f89cae"
        },
        "GatewayId": {
          "Ref": "vgwad03f2c4"
        }
      },
      "DependsOn": "gw2"
    },
    "dchpassoc1": {
      "Type": "AWS::EC2::VPCDHCPOptionsAssociation",
      "Properties": {
        "VpcId": {
          "Ref": "vpcc435f6be"
        },
        "DhcpOptionsId": {
          "Ref": "doptb19f8cd3"
        }
      }
    },
    "assoc1": {
      "Type": "AWS::EC2::EIPAssociation",
      "Properties": {
        "AllocationId": {
          "Fn::GetAtt": [
            "eip5220521546",
            "AllocationId"
          ]
        },
        "InstanceId": {
          "Ref": "instancei0f53f5e060f17a985"
        }
      }
    },
    "ingress1": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "9000",
        "ToPort": "9000",
        "CidrIp": "10.0.0.0/16"
      }
    },
    "ingress2": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "8080",
        "ToPort": "8080",
        "CidrIp": "190.94.211.58/32"
      }
    },
    "ingress3": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "8080",
        "ToPort": "8080",
        "CidrIp": "200.109.231.146/32"
      }
    },
    "ingress4": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "22",
        "ToPort": "22",
        "CidrIp": "10.0.0.0/16"
      }
    },
    "ingress5": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "22",
        "ToPort": "22",
        "CidrIp": "190.94.211.58/32"
      }
    },
    "ingress6": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "22",
        "ToPort": "22",
        "CidrIp": "200.109.231.146/32"
      }
    },
    "ingress7": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "6379",
        "ToPort": "6379",
        "CidrIp": "10.0.0.0/16"
      }
    },
    "ingress8": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "5000",
        "ToPort": "5000",
        "CidrIp": "10.0.0.0/16"
      }
    },
    "ingress9": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "5601",
        "ToPort": "5601",
        "CidrIp": "10.0.0.0/16"
      }
    },
    "ingress10": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "5601",
        "ToPort": "5601",
        "CidrIp": "10.1.100.0/24"
      }
    },
    "ingress11": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "5601",
        "ToPort": "5601",
        "CidrIp": "10.10.114.0/24"
      }
    },
    "ingress12": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "5601",
        "ToPort": "5601",
        "CidrIp": "10.10.122.0/24"
      }
    },
    "ingress13": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "5601",
        "ToPort": "5601",
        "CidrIp": "172.31.31.0/24"
      }
    },
    "ingress14": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "icmp",
        "FromPort": "-1",
        "ToPort": "-1",
        "CidrIp": "10.1.100.0/24"
      }
    },
    "ingress15": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "icmp",
        "FromPort": "-1",
        "ToPort": "-1",
        "CidrIp": "10.10.112.0/24"
      }
    },
    "ingress16": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "icmp",
        "FromPort": "-1",
        "ToPort": "-1",
        "CidrIp": "10.10.114.0/24"
      }
    },
    "ingress17": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "icmp",
        "FromPort": "-1",
        "ToPort": "-1",
        "CidrIp": "172.31.31.0/24"
      }
    },
    "ingress18": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "9300",
        "ToPort": "9400",
        "CidrIp": "10.0.0.0/16"
      }
    },
    "ingress19": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "tcp",
        "FromPort": "9200",
        "ToPort": "9200",
        "CidrIp": "10.0.0.0/16"
      }
    },
    "ingress20": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgBancopanamahttp"
        },
        "IpProtocol": "tcp",
        "FromPort": "80",
        "ToPort": "80",
        "CidrIp": "0.0.0.0/0"
      }
    },
    "ingress21": {
      "Type": "AWS::EC2::SecurityGroupIngress",
      "Properties": {
        "GroupId": {
          "Ref": "sgBancopanamahttp"
        },
        "IpProtocol": "tcp",
        "FromPort": "443",
        "ToPort": "443",
        "CidrIp": "0.0.0.0/0"
      }
    },
    "egress1": {
      "Type": "AWS::EC2::SecurityGroupEgress",
      "Properties": {
        "GroupId": {
          "Ref": "sgbancopanamaQA"
        },
        "IpProtocol": "-1",
        "CidrIp": "0.0.0.0/0"
      }
    },
    "egress2": {
      "Type": "AWS::EC2::SecurityGroupEgress",
      "Properties": {
        "GroupId": {
          "Ref": "sgBancopanamahttp"
        },
        "IpProtocol": "-1",
        "CidrIp": "0.0.0.0/0"
      }
    },
    "croute1": {
      "Type": "AWS::EC2::VPNConnectionRoute",
      "Properties": {
        "VpnConnectionId": {
          "Ref": "vpncab6a8ab"
        },
        "DestinationCidrBlock": "10.1.100.0/24"
      }
    },
    "croute2": {
      "Type": "AWS::EC2::VPNConnectionRoute",
      "Properties": {
        "VpnConnectionId": {
          "Ref": "vpncab6a8ab"
        },
        "DestinationCidrBlock": "172.31.31.0/24"
      }
    },
    "croute3": {
      "Type": "AWS::EC2::VPNConnectionRoute",
      "Properties": {
        "VpnConnectionId": {
          "Ref": "vpncab6a8ab"
        },
        "DestinationCidrBlock": "134.177.251.237/32"
      }
    },
    "croute4": {
      "Type": "AWS::EC2::VPNConnectionRoute",
      "Properties": {
        "VpnConnectionId": {
          "Ref": "vpncab6a8ab"
        },
        "DestinationCidrBlock": "10.10.114.0/24"
      }
    },
    "croute5": {
      "Type": "AWS::EC2::VPNConnectionRoute",
      "Properties": {
        "VpnConnectionId": {
          "Ref": "vpncab6a8ab"
        },
        "DestinationCidrBlock": "10.10.122.0/24"
      }
    },
    "croute6": {
      "Type": "AWS::EC2::VPNConnectionRoute",
      "Properties": {
        "VpnConnectionId": {
          "Ref": "vpncab6a8ab"
        },
        "DestinationCidrBlock": "192.177.1.0/24"
      }
    }
  },
  "Description": "Cloud Former walkthrough template"
}
```
