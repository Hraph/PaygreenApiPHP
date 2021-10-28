#!/bin/bash
VERSION=1.1.0
openapi-generator generate --skip-validate-spec -i ./open-api/paygreen-all.json -g php --additional-properties invokerPackage="Hraph\PaygreenApi" --additional-properties artifactVersion=${VERSION} --additional-properties httpUserAgent="Hraph/Paygreen-Api-PHP/${VERSION}" -o ./
