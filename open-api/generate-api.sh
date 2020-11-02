#!/bin/bash
openapi-generator generate --skip-validate-spec -i ./open-api/paygreen-all.json -g php --additional-properties invokerPackage="Hraph\PaygreenApi" -o ./
